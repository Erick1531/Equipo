document.addEventListener("DOMContentLoaded", function () {
    // Mostrar productos
    fetch("api_productos.php")
        .then(response => response.json())
        .then(data => {
            let productosHTML = "";
            data.forEach(producto => {
                productosHTML += `
                    <div class="producto" id="producto-${producto.id}">
                        <h3>${producto.nombre}</h3>
                        <p>${producto.descripcion}</p>
                        <p><strong>Precio:</strong> $${producto.precio}</p>
                        <p><strong>Stock:</strong> ${producto.stock}</p>
                        <button onclick="eliminarProducto(${producto.id})">Eliminar</button>
                    </div>
                `;
            });
            document.getElementById("productos").innerHTML = productosHTML;
        })
        .catch(error => console.error("Error al obtener los productos:", error));

    // Agregar producto
    document.getElementById("addProductForm").addEventListener("submit", function (e) {
        e.preventDefault();
        
        const nombre = document.getElementById("nombre").value;
        const descripcion = document.getElementById("descripcion").value;
        const precio = document.getElementById("precio").value;
        const stock = document.getElementById("stock").value;
        
        fetch("api_productos.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ nombre, descripcion, precio, stock })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            window.location.reload();  // Recargar para mostrar el nuevo producto
        })
        .catch(error => console.error("Error al agregar el producto:", error));
    });
});

// Eliminar producto
function eliminarProducto(id) {
    fetch("api_productos.php", {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ id })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        document.getElementById(`producto-${id}`).remove();  // Eliminar producto de la vista
    })
    .catch(error => console.error("Error al eliminar el producto:", error));
}
