function successMsg(mensagem) {
    Toastify({
        text: mensagem,
        duration: 3000,
        position: "center"
    }).showToast();
}
function errorMsg(mensagem) {
    Toastify({
        text: mensagem,
        duration: 3000,
        position: "center",
        style: {
            background: "red",
        },
    }).showToast();
}
