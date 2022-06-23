<?php
include "db.php";
   if(function_exists($_GET['function'])) {
         $_GET['function']();
      }   
   function get_product()
   {
      global $conn;      
      $query = $conn->query("SELECT * FROM tb_product");            
      while($row=mysqli_fetch_object($query))
      {
         $data[] =$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Success',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }   
   
   function get_product_id()
   {
      global $conn;
      if (!empty($_GET["id"])) {
         $id = $_GET["id"];      
      }            
      $query ="SELECT * FROM produk WHERE product_id= $id";      
      $result = $conn->query($query);
      while($row = mysqli_fetch_object($result))
      {
         $data[] = $row;
      }            
      if($data)
      {
      $response = array(
                     'status' => 1,
                     'message' =>'Success',
                     'data' => $data
                  );               
      }else {
         $response=array(
                     'status' => 0,
                     'message' =>'No Data Found'
                  );
      }
      
      header('Content-Type: application/json');
      echo json_encode($response);
       
   }
   function insert_product()
      {
         global $conn;   
         $check = array('category_id' => '', 'product_name' => '', 'product_price' => '');
         $check_match = count(array_intersect_key($_POST, $check));
         if($check_match == count($check)){
         
               $result = mysqli_query($conn, "INSERT INTO tb_product SET
               category_id = '$_POST[category_id]',
               nama = '$_POST[nama]',
               jenis_kelamin = '$_POST[jenis_kelamin]',
               alamat = '$_POST[alamat]'");
               
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Insert Success'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Insert Failed.'
                  );
               }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Wrong Parameter'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
   function update_product()
      {
         global $conn;
         if (!empty($_GET["id"])) {
         $id = $_GET["id"];      
      }   
         $check = array('category_id' => '', 'product_name' => '', 'product_price' => '');
         $check_match = count(array_intersect_key($_POST, $check));         
         if($check_match == count($check)){
         
              $result = mysqli_query($conn, "UPDATE tb_product SET               
               product_name = '$_POST[product_name]',
               product_price = '$_POST[product_price]',
               product_image = '$_POST[product_image]' WHERE id = $id");
         
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Update Success'                  
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Update Failed'                  
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Wrong Parameter',
                     'data'=> $id
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
   function delete_product()
   {
      global $conn;
      $id = $_GET['id'];
      $query = "DELETE FROM tb_product WHERE product_id=".$id;
      if(mysqli_query($conn, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Delete Success'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Delete Fail.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 ?>