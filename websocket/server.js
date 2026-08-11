const fs = require("fs");
const https = require("https");
const jwt = require("jsonwebtoken");
const WebSocket = require("ws");
const JWT_SECRET = process.env.JWT_SECRET || "webcast";
const server = https.createServer({
	key: fs.readFileSync("/ssl/server.key"),
	cert: fs.readFileSync("/ssl/server.crt"),
});
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

	ws.on("message", (message) => {
		let data;

		try {
			data = JSON.parse(message.toString());
		} catch {
			ws.send(
				JSON.stringify({
					type: "error",
					message: "Invalid JSON",
				}),
			);

			return;
		}
		if (data.action === "auth") {
			if (!data.token) {
				ws.send(
					JSON.stringify({
						type: "auth",
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

				console.log(`Login : ${payload.name} (${payload.role})`);

				ws.send(
					JSON.stringify({
						type: "auth",
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
						type: "auth",
						success: false,
						message: "Invalid JWT",
					}),
				);

				ws.close(1008, "Unauthorized");
			}

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
