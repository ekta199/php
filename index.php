<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!--bootstrap link-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <!--fontawsome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>
  <!--Data tables link-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

</head>

<body>

  <div class="container">
    <!--main-->
    <div class="card">
      <!--card 1 start-->
      <?php
      if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
      ?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Hey!</strong><?php echo $_SESSION['status'] ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

      <?php
        unset($_SESSION['status']);
      }
      ?>
      <h5 class="card-header"></h5>
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-cheese text-success">Crud</i></h5>
        <!--add new record-->
        <div class="col-6  d-inline-block">
          <!-- Modal -->
          <div class="modal fade" id="addnewmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addnewmodal">Add new record</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="insert.php" method="POST">
                  <!--add form-->
                  <div class="modal-body">

                    <div class="form-group">
                      <label for="title">title</label>
                      <input type="text" name="title" class="form-control" id="inputtitle">

                    </div>
                    <div class="form-group">
                      <label for="title">Author</label>
                      <input type="text" name="author" class="form-control" id="inputtitle">

                    </div>
                    <div class="form-group">
                      <label for="title">Publisher</label>
                      <input type="text" name="publish" class="form-control" id="inputtitle">

                    </div>
                    <div class="form-group">
                      <label for="title">stock</label>
                      <input type="text" name="stock" class="form-control" id="inputtitle">

                    </div>

                  </div>

                  <div class="modal-footer">
                    <button type="submit" name="saveadd" class="btn btn-success">save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--add new end-->

        <div class="form-group d-flex flex-row float-right">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-info float-right ml-2 " data-toggle="modal" data-target="#addnewmodal">
          <i class="far fa-plus-square"> Add new record</i>
          </button>

          <a href="#" class="btn btn-info float-right ml-2">  <i class="fas fa-sort">filter</i></a>
          <a href="#" class="btn btn-danger float-right ml-2">  <i class="fas fa-times">Clear Filter</i></a>


        </div>
      </div>
    </div>
    <!--card 1 end-->








    <div class="container">
      <!--table container-->
      <div class="row">
        <div class="col-md-12 mt-4">
          <div class="card-header">

          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="search" name="filter_value" class="form-control" placeholder="search record...">
                  </div>
                </div>
                <div class="col-md-6">
                  <button type="submit" name="filter_btn" class="btn btn-info"><i class="fas fa-search">Search</i> </button>

                </div>

              </div>
            </form>
            <table class="table  table-bordered table-hover table-responsive-sm table-responsive-md mt-5" id="mydatatable">

              <thead>
                <tr class="bg-success">
                  <th class="text-center text-white" colspan="8">Data table</th>
                </tr>
                <tr>
                  <th scope="col">S.no.</th>
                  <th scope="col">Title</th>
                  <th scope="col">Author</th>
                  <th scope="col">publishor</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Action</th>

                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"></th>
                  <?php
                  $con = mysqli_connect("localhost", "root", "", "edb");
                  $query = "SELECT*FROM fresh";

                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) {

                    foreach ($query_run as $row) {

                  ?>
                <tr>
                  <td class="stud_id"><?php echo $row['id']; ?> </td>
                  <td><?php echo $row['title']; ?> </td>
                  <td><?php echo $row['author']; ?> </td>
                  <td><?php echo $row['publish']; ?> </td>
                  <td><?php echo $row['stock']; ?> </td>
                  <td>
                    <a class="btn btn-info view_btn" href="#" role="button"> <i class="fas fa-table">view</i></a>
                    <a class="btn btn-warning edit_btn" href="#" role="button"> <i class="far fa-edit">edit</i></a>
                    <a class="btn btn-danger delete_btn" href="#" role="button"> <i class="fas fa-trash">delete</i></a>
                  </td>

                </tr>

            <?php
                    }
                  } else {
                    echo "<h5>no record found </h5>";
                  }

            ?>
            <tr>
            <?php
            $con = mysqli_connect("localhost", "root", "", "edb");

            if (isset($_POST['filter_btn'])) 
            {
              $search = $_POST['filter_value'];

              $qy = " SELECT * FROM fresh WHERE CONCAT(title,author,stock) LIKE '%$search%' ";

              $query_rn = mysqli_query($con,$qy);

              if (mysqli_num_rows($query_rn) > 0) 
              {
                while ($row = mysqli_fetch_array($query_rn))
                 {
                    ?>
                  <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo $row['publish']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                  </tr>
                   <?php

                }
              } else {
                     ?>
                     <tr>
                        <td colspan="8">
                          No record found
                     </td>
                  </tr>

            <?php

              }
            }



            ?>
            </tr>
            <div class="jutify-content-center">
              <!--edit view delete-->
              <!--edit-->
              <div class="float-right mb-5">
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="editmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editmodal">Edit record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <form action="edit.php" method="POST">
                          <input type="text" name="edit_id" id="edit_id" class="form-control">
                          <div class="form-group">
                            <label for="title">title</label>
                            <input type="text" name="title" id="atitle" class="form-control" id="inputtitle">

                          </div>
                          <div class="form-group">
                            <label for="title">Author</label>
                            <input type="text" name="author" id="bauthor" class="form-control" id="inputtitle">

                          </div>
                          <div class="form-group">
                            <label for="title">Publisher</label>
                            <input type="text" name="publish" id="cpublish" class="form-control" id="inputtitle">

                          </div>
                          <div class="form-group">
                            <label for="title">stock</label>
                            <input type="text" name="stock" id="dstock" class="form-control" id="inputtitle">

                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="update_btn" class="btn btn-success">update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--edit new end-->
              <div class="">
                <!--delete-->
                <!-- Button trigger modal -->


                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal">Delete data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="delete.php" method="POST">
                        <div class="modal-body">
                          <input type="hidden" name="delete_id" id="delete_id" class="form-control">
                          Are you sure, you want to delete this data?
                        </div>
                        <div class="modal-footer">
                          <button type="Submit" name="delete_d" class="btn btn-success">Confirm</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                        </div>
                      </form>
                    </div>
                  </div>
                </div>


              </div>
              <!--delete-->
            </div>
            <!--view-->
            <!-- Modal -->
            <div class="modal fade" id="studview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="studview">View Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="student_viewing_data">

                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                  </div>
                </div>
              </div>
            </div>
            <!--view end-->
            <!--edit view delete-->
            </tr>
              </tbody>
              <tfoot>
                <tr>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--table container end-->





  </div>
  <!--main end-->










  <!--javascript link-->
  <script src="http://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {


      $('.delete_btn').click(function(e) {
        e.preventDefault();
        var stud_id = $(this).closest('tr').find('.stud_id').text();
        //console.log(stud_id);
        $('#delete_id').val(stud_id);
        $('#deleteModal').modal('show');

      });




      $('.edit_btn').click(function(e) {
        e.preventDefault();
        var b_id = $(this).closest('tr').find('.stud_id').text();
        //console.log(b_id);
        $.ajax({
          type: "POST",
          url: "edit.php",
          data: {
            'checking_edit_btn': true,
            'book_id': b_id,
          },


          success: function(response) {
            //console.log(response);
            $.each(response, function(key, value) {
              //console.log(value['title']);
              $('#edit_id').val(value['id']);
              $('#atitle').val(value['title']);
              $('#bauthor').val(value['author']);
              $('#cpublish').val(value['publish']);
              $('#dstock').val(value['stock']);
            });

            $('#editmodal').modal('show');
          }
        });

      });

      //view btn//
      $('.view_btn').click(function(e) {
        e.preventDefault();
        var stud_id = $(this).closest('tr').find('.stud_id').text();
        //console.log(stud_id);
        $.ajax({
          type: "POST",
          url: "insert.php",
          data: {
            'checking_viewbtn': true,
            'student_id': stud_id,
          },


          success: function(response) {
            //console.log(response);
            $('.student_viewing_data').html(response);
            $('#studview').modal('show');
          }
        });

      });

    });
  </script>






</body>

</html>