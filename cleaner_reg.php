<?php 
    session_start();
    require_once "config/db.php";

    if(isset($_SESSION['cleaner_login'])){
        $sqlReg = $conn->prepare("SELECT cleaner_reg.status FROM cleaner_reg WHERE cleaner_reg.user_id ='".$_SESSION['cleaner_login']."'");
        $sqlReg->execute();
        $Reg = $sqlReg->fetch(PDO::FETCH_ASSOC);

        if($Reg!=0){
            header("location: index.php");
        }
    }else{
        header("location: index.php");
    }

    if(isset($_POST['cleaner_reg'])){

        $user_cleaner_reg = $_SESSION['cleaner_login'];
        $status = 0;
        $imgProof = $_FILES['imgProof'];



        $allow1 = array('jpg', 'jpeg', 'png');
        $extension1 = explode('.', $imgProof['name']);
        $fileActExt1 = strtolower(end($extension1));
        $fileNew1 = rand() . "." . $fileActExt1;  // rand function create the rand number 
        $filePath1 = 'uploads/cleaner_proof/'.$fileNew1;

        $stmt =$conn->prepare("INSERT INTO cleaner_reg(user_id, imgProof, status) 
        VALUES (:user_id, :imgProof, :status)");
 
        $stmt->bindParam(":user_id",$user_cleaner_reg);
        $stmt->bindParam(":imgProof",$fileNew1);
        $stmt->bindParam(":status",$status);
        $stmt->execute();

        if($stmt){
            unset($stmt);
            header("location: profile.php?user=$user_cleaner_reg");
        }else{
            unset($stmt);
            header("location: proflie.php?user=$user_cleaner_reg");
        }
    }
?>

<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ส่งหลักฐาน | NiceClean</title>
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
              <h1 class="text-4xl font-semibold text-white">ส่งหลักฐาน</h1>
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
      <div class="custom-shape-divider-bottom-1664647965">
          <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
              <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
          </svg>
      </div>
    </div>
    <!-- ====== Banner Section End -->

    <!-- ====== Forms Section Start -->
    <section class="bg-[#F4F7FF] py-14 lg:py-20">
      <div class="container">
        <div class="-mx-4 flex flex-wrap">
          <div class="w-full px-4">
          <div class="p-2">
            <div class="p-8 bg-white shadow-lg">
                <form action="cleaner_reg.php" method="post" class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
                    <div class="md:col-span-2 mx-auto">
                        <div class="relative rounded-md overflow-hidden">
                            <img src="assets/images/example/IDcard.jpg" alt="IDcard" class="object-cover w-full h-full" />
                            <div class="absolute w-full py-2.5 bottom-0 inset-x-0 bg-gray-800 bg-opacity-50 text-white text-xl font-bold text-center leading-4">ตัวอย่าง</div>
                        </div>
                    </div>
                    <div class="md:w-80">
                        <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">รูปหลักฐานบัตรประชาชน <p class="text-red-500">* สำคัญมาก</p></label>
                        <div class="flex justify-center items-center">
                            <label for="imgInputProof" class="flex flex-col justify-center items-center w-full h-32 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                    <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">คลิก เพื่อเพิ่มรูปบัตรประชาชน</span></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or JPEG</p>
                                </div>
                                <input accept="image/png, image/jpeg, image/jpg" required  id="imgInputProof" name="imgProof" type="file" class="hidden" />
                            </label>
                        </div>
                    </div>
                    <div class="mb-6 mt-6">
                        <img loading="lazy" src="assets/images/example/noimg.jpg" class="mx-auto" width="50%" id="previewImgProof" alt="">
                    </div>

                    <button
                        type="submit"
                        name="cleaner_reg"
                        class="flex text-center justify-between w-1/2 px-6 py-3 text-sm tracking-wide text-white capitalize transition-colors duration-300 transform bg-primary rounded-md hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        <span>ส่งหลักฐาน</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Forms Section End -->

    <!-- ====== Footer Section Start -->
    <?php include("includes/footer.php") ?>
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
    <script>
        let imgInputProof = document.getElementById('imgInputProof');
        let previewImgProof = document.getElementById('previewImgProof');

        imgInputProof.onchange = evt => {
            const [file] = imgInputProof.files;
                if (file) {
                    previewImgProof.src = URL.createObjectURL(file)
            }
        }
    </script>
  </body>
</html>
