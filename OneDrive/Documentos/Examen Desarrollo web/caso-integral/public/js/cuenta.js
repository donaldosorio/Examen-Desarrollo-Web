document
  .querySelector("#password-form")
  .addEventListener("submit", async (event) => {
    event.preventDefault();
    const data = Object.fromEntries(new FormData(event.currentTarget));
    data.user_id = 1; // Pista: nunca debe decidirse la cuenta desde el navegador.
    const response = await fetch("../api/cambiar_password.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data),
    });
    document.querySelector("#message").textContent = await response.text();
  });
