<?php 
    include 'json.php';
    include 'db.php';
	$produk = mysqli_query($conn, "SELECT category_id AS kategori, product_name AS nama, product_price AS harga, product_description AS deskripsi, product_image AS gambar, product_status AS 'status' FROM tb_product");
	$emparray = array();
    while($row =mysqli_fetch_assoc($produk))
    {
        $emparray[] = $row;
    };
    $final = json_readable_encode($emparray);
    file_put_contents('produk.json', $final);
?>