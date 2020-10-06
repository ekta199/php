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