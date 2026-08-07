const fs = require('fs');
const https = require('https');
const { Server } = require('socket.io');

const options = {
  key: fs.readFileSync('/ssl/server.key'),
  cert: fs.readFileSync('/ssl/server.crt')
};

const server = https.createServer(options);

const io = new Server(server, {
  cors: {
    origin: "*"
  }
});

io.on("connection", (socket) => {
  console.log("Client connected:", socket.id);

  socket.emit("message", "Halo dari server WebSocket!");

  socket.on("chat", (msg) => {
    console.log("Pesan dari client:", msg);
    socket.broadcast.emit("chat", msg);
  });

  socket.on("disconnect", () => {
    console.log("Client disconnected:", socket.id);
  });
});

const PORT = 3000;

server.listen(PORT, () => {
  console.log(`Secure WebSocket server listening on port ${PORT}`);
});
