<?php 
    session_start();
    require_once "config/db.php";

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->prepare("DELETE FROM post WHERE post_id = $delete_id");
        $deletestmt->execute();

        if ($deletestmt) {
            echo "<script>alert('Data has been deleted successfully');</script>";
            header("location: post_own.php");
        }               
    }

?>

<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>โพสต์ของฉัน | NiceClean</title>
    <link
      rel="shortcut icon"
      href="assets/images/favicon.png"
      type="image/x-icon"
    />

    <!-- ==== WOW JS ==== -->
    <script src="assets/js/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>
  </head>
  <body>
    <!-- ====== Header Start ====== -->
    <?php include("includes/navbar_role_check.php") ?>
    <!-- ====== Header End ====== -->

    <!-- ====== Banner Section Start -->
    <div
      class="relative z-10 overflow-hidden bg-primary pt-[120px] pb-[100px] md:pt-[130px] lg:pt-[160px]"
    >
      <div class="container">
        <div class="-mx-4 flex flex-wrap items-center">
          <div class="w-full px-4">
            <div class="text-center">
              <h1 class="text-4xl font-semibold text-white">โพสต์ของฉัน</h1>
            </div>
          </div>
        </div>
      </div>
      <div>
        <span class="absolute top-0 left-0 z-[-1]">
          <svg
            width="495"
            height="470"
            viewBox="0 0 495 470"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle
              cx="55"
              cy="442"
              r="138"
              stroke="white"
              stroke-opacity="0.04"
              stroke-width="50"
            />
            <circle
              cx="446"
              r="39"
              stroke="white"
              stroke-opacity="0.04"
              stroke-width="20"
            />
            <path
              d="M245.406 137.609L233.985 94.9852L276.609 106.406L245.406 137.609Z"
              stroke="white"
              stroke-opacity="0.08"
              stroke-width="12"
            />
          </svg>
        </span>
        <span class="absolute top-0 right-0 z-[-1]">
          <svg
            width="493"
            height="470"
            viewBox="0 0 493 470"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle
              cx="462"
              cy="5"
              r="138"
              stroke="white"
              stroke-opacity="0.04"
              stroke-width="50"
            />
            <circle
              cx="49"
              cy="470"
              r="39"
              stroke="white"
              stroke-opacity="0.04"
              stroke-width="20"
            />
            <path
              d="M222.393 226.701L272.808 213.192L259.299 263.607L222.393 226.701Z"
              stroke="white"
              stroke-opacity="0.06"
              stroke-width="13"
            />
          </svg>
        </span>
      </div>
      <div class="custom-shape-divider-bottom-1664647808">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
    </div>
    <!-- ====== Banner Section End -->

    <!-- ====== Forms Section Start -->

    
    <section class="pt-20 pb-10 lg:pt-[120px] lg:pb-20">
      <div class="container mx-auto">
        <div class="flex flex-wrap -mx-4">
          <div class="w-full px-4">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                  <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                      <tr>
                          <th scope="col" class="py-3 px-6">
                              <span class="sr-only">รูป</span>
                          </th>
                          <th scope="col" class="py-3 px-6">
                              โพสต์
                          </th>
                          <th scope="col" class="py-3 px-6">
                              Action
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sqlPostOwn = $conn->prepare("SELECT * FROM post,users WHERE post.user_id='".$cleaner_id."' AND users.user_id='".$cleaner_id."' ORDER BY post.post_id DESC");
                      $sqlPostOwn->execute();
                      $sqlSelect = $sqlPostOwn->fetchAll(PDO::FETCH_ASSOC);
                  ?>
                    <?php foreach($sqlSelect as $q){ ?>
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="p-4 w-32 max-h-20">
                          <a href="<?php echo 'post_detail.php?post_id='.$q['post_id']; ?>">
                            <img src="uploads/posts/<?php echo $q['img_title']; ?>" alt="img_post">
                          </a>
                        </td>
                        <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                          <?php echo $q['title']; ?>
                        </td>
                        <td class="py-4 px-6 flex-wrap flex">
                          <a href="post_edit.php?post_id=<?php echo $q['post_id']; ?>" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-500 font-medium rounded-lg text-sm px-2 py-2 mr-2 mb-2 dark:focus:ring-yellow-900">
                            แก้ไขโพสต์
                          </a>
                          <a href="post_exday.php?post_id=<?php echo $q['post_id']; ?>" class="focus:outline-none text-white bg-sky-400 hover:bg-sky-500 focus:ring-4 focus:ring-sky-500 font-medium rounded-lg text-sm px-2 py-2 mr-2 mb-2 dark:focus:ring-sky-900">
                            เพิ่มวันหยุด
                          </a>
                          <a data-id="<?php echo $q['post_id']; ?>" href="?delete=<?php echo $q['post_id']; ?>" class="delete-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            ลบ
                          </a>
                        </td>
                      </tr>
                    <?php }?>
                  </tbody>
              </table>              
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Forms Section End -->

    <!-- ====== Footer Section Start -->

    <!-- ====== Footer Section End -->

    <!-- ====== Back To Top Start -->
    <a
      href="javascript:void(0)"
      class="back-to-top fixed bottom-8 right-8 left-auto z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark"
    >
      <span
        class="mt-[6px] h-3 w-3 rotate-45 border-t border-l border-white">
      </span>
    </a>
    <!-- ====== Back To Top End -->

    <!-- ====== All Scripts -->
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      $('.delete-btn').click(function(e) {
          const postId = $(this).data('id')
          e.preventDefault();
          deleteConfirm(postId);
      })

      function deleteConfirm(postId) {
        Swal.fire({
          title: 'ลบโพสต์',
          text: 'ทำการยืนยันเพื่อลบโพสต์',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'ยืนยันการลบ',
          cancelButtonColor: '#d33',
          cancelButtonText: 'ยกเลิก',
          showLoaderOnConfirm: true,
          preConfirm: function(){
            return new Promise(function(resolve) {
              $.ajax({
                url: 'post_own.php',
                type: 'GET',
                data: 'delete=' + postId,
              })
              .done(function() {
                Swal.fire({
                  title: 'success',
                  text: 'ลบสำเร็จแล้ว',
                  icon: 'success'
                }).then(() => {
                  document.location.href = 'post_own.php';
                })
              })
              .fail(function() {
                Swal.fire('แย่แล้ว', 'มีบางอย่างผิดพลาด กับ ajax', 'error')
                window.location.reload();
              })
            })
          }
        })
        
      }
    </script>
  </body>
</html>
