const fs = require("fs");
const https = require("http");
const jwt = require("jsonwebtoken");
const WebSocket = require("ws");
const JWT_SECRET = process.env.JWT_SECRET || "webcast";
const server = https.createServer();
// const server = https.createServer({
// 	key: fs.readFileSync("/ssl/server.key"),
// 	cert: fs.readFileSync("/ssl/server.crt"),
// });
const wss = new WebSocket.Server({
	server,
	maxPayload: 16 * 1024,
});
wss.on("connection", (ws, req) => {
	const url = new URL(req.url, "https://localhost");
	ws.room = url.pathname.replace(/^\/+/, "");

	ws.user = null;
	ws.authenticated = false;

	console.log(`Client Connected -> Room : ${ws.room}`);

	ws.send(
		JSON.stringify({
			type: "welcome",
			room: ws.room,
			message: "Please login.",
		}),
	);
	ws.on("close", (code, reason) => {
		ws.user_join = false;
		var listUser = [];
		wss.clients.forEach((client) => {
			if (client.readyState === WebSocket.OPEN && client.user_join == true) {
				listUser.push({
					user_id: client.user_id,
				});
			}
		});
		wss.clients.forEach((client) => {
			if (client.readyState === WebSocket.OPEN) {
				if (client.moderator_flag == true) {
					client.send(
						JSON.stringify({
							action: "USER_LIST",
							list: listUser,
						}),
					);
				} else {
					client.send(
						JSON.stringify({
							action: "USER_LIST",
							count: listUser.length,
						}),
					);
				}
			}
		});
	});
	ws.on("message", (message) => {
		let data;

		try {
			data = JSON.parse(message.toString());
		} catch {
			ws.send(
				JSON.stringify({
					action: "ERROR",
					message: "Invalid JSON",
				}),
			);

			return;
		}
		if (data.action === "AUTH") {
			if (!data.token) {
				ws.send(
					JSON.stringify({
						action: "AUTH",
						success: false,
						message: "Token required",
					}),
				);

				return;
			}
			try {
				const payload = jwt.verify(data.token, JWT_SECRET);

				ws.user = payload;
				ws.authenticated = true;
				ws.user_id = data.user_id;
				ws.user_name = data.user_name;
				ws.moderator_flag = data.moderator_flag;
				ws.user_join = false;
				console.log(`Login : ${payload.name} (${payload.role})`);

				ws.send(
					JSON.stringify({
						action: "AUTH",
						success: true,
						user: {
							id: payload.id,
							name: payload.name,
							role: payload.role,
						},
					}),
				);
			} catch {
				ws.send(
					JSON.stringify({
						action: "AUTH",
						success: false,
						message: "Invalid JWT",
					}),
				);

				ws.close(1008, "Unauthorized");
			}

			return;
		}
		if (data.action === "USER_JOIN" || data.action === "USER_LEFT") {
			if (data.action === "USER_JOIN") {
				ws.user_join = true;
			} else {
				ws.user_join = false;
			}
			var listUser = [];
			wss.clients.forEach((client) => {
				if (client.readyState === WebSocket.OPEN && client.user_join == true) {
					listUser.push({
						user_id: client.user_id,
					});
				}
			});
			wss.clients.forEach((client) => {
				if (client.readyState === WebSocket.OPEN) {
					if (client.moderator_flag == true) {
						client.send(
							JSON.stringify({
								action: "USER_LIST",
								list: listUser,
							}),
						);
					} else {
						client.send(
							JSON.stringify({
								action: "USER_LIST",
								count: listUser.length,
							}),
						);
					}
				}
			});
			return;
		}
		if (!ws.authenticated) {
			ws.close(1008, "Authentication required");
			return;
		}
		wss.clients.forEach((client) => {
			if (client !== ws && client.readyState === WebSocket.OPEN) {
				client.send(message.toString());
			}
		});
	});
});
server.listen(3000, () => {
	console.log("WebSocket running on 3000");
});
