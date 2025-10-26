// chat.js — conexión básica a la API de Google Gemini

const API_KEY = "AIzaSyDELss228PXe9w6zacQxhOcKRRQ5z3JUiM";
const MODEL = "gemini-1.5-flash";

const input = document.getElementById("user-input");
const sendBtn = document.getElementById("send-btn");
const chatBox = document.getElementById("chat-box");

sendBtn.addEventListener("click", enviarMensaje);
input.addEventListener("keypress", (e) => {
    if (e.key === "Enter") enviarMensaje();
});

async function enviarMensaje() {
    const textoUsuario = input.value.trim();
    if (textoUsuario === "") return;

    // Mostrar mensaje del usuario
    mostrarMensaje(textoUsuario, "usuario");
    input.value = "";

    // Mostrar mensaje de "pensando..."
    const pensando = mostrarMensaje("...", "ia");

    try {
        const respuesta = await fetch(
           
            `https://generativelanguage.googleapis.com/v1beta/models/${MODEL}:generateContent?key=${API_KEY}`,
            {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    contents: [{ parts: [{ text: textoUsuario }] }]
                })
            }
        );

        const datos = await respuesta.json();
        const textoIA = datos?.candidates?.[0]?.content?.parts?.[0]?.text || "No entendí eso 🤖";

        // Reemplaza el mensaje de "..." con la respuesta real
        pensando.remove();
        mostrarMensaje(textoIA, "ia");

    } catch (error) {
        pensando.remove();
        mostrarMensaje("⚠️ Error al conectar con la IA.", "ia");
        console.error(error);
    }
}

function mostrarMensaje(texto, tipo) {
    const div = document.createElement("div");
    div.classList.add("mensaje", tipo);
    div.textContent = texto;
    chatBox.appendChild(div);
    chatBox.scrollTop = chatBox.scrollHeight;
    return div;
}
