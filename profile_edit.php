<?php 
    session_start();
    require_once "config/db.php";

    if(isset($_GET['user'])){
        $user_id = $_GET['user'];

        if($user_id != $_SESSION['user_id']){
            echo "<script>alert('ไม่ใช่โปรไฟล์ของคุณ');window.location='index.php';</script>";
        }else{
            $stmt = $conn->prepare("SELECT * FROM users WHERE users.user_id =$user_id");
            $stmt->execute();
            $profileEdit = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

?>

<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $profileEdit['firstname']." ".$profileEdit['lastname']?> | NiceClean</title>
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
              <h1 class="text-4xl font-semibold text-white">แก้ไขโปรไฟล์</h1>
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
    </div>
    <!-- ====== Banner Section End -->

    <!-- ====== Forms Section Start -->
    <section class="bg-[#F4F7FF] py-14 lg:py-20">
      <div class="container">
        <div class="-mx-4 flex flex-wrap">
          <div class="w-full px-4">
            <div class="wow fadeInUp bg-white rounded overflow-hidden shadow-lg flex items-center w-full max-w-3xl p-8 mx-auto lg:px-12 lg:w-3/5" data-wow-delay=".1s">
                
                <?php if(isset($_SESSION['error'])) { ?>
                    <div class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>
                <?php if(isset($_SESSION['success'])) { ?>
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </div>
                <?php } ?>
                <?php if(isset($_SESSION['warning'])) { ?>
                    <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
                        <?php
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                        ?>
                    </div>
                <?php } ?>

                <form action="profile_edit_db.php" method="POST"  enctype="multipart/form-data" class="grid grid-cols-1 gap-6 mx-auto mt-8 md:grid-cols-1">
                
                <input type="hidden" readonly value="<?php echo $profileEdit['user_id']; ?>" name="user_id" required>
                <input type="hidden" value="<?php echo $profileEdit['img']; ?>"name="img2" required>

                    <div class="md:col-span-2 md:w-80">
                        <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">อีเมล</label>
                        <input type="text" value="<?php echo $profileEdit['email']?>" name="email" readonly required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-gray-100 border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                    </div>

                    <div class="md:w-80">
                        <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">ชื่อจริง</label>
                        <input type="text" value="<?php echo $profileEdit['firstname']?>" name="firstname"  required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                    </div>

                    <div class="md:w-80">
                        <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">นามสกุล</label>
                        <input type="text" value="<?php echo $profileEdit['lastname']?>" name="lastname"  required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                    </div>

                    <div class="md:w-80">
                        <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">เบอร์โทรศัพท์</label>
                        <input type="text" value="<?php echo $profileEdit['phone']?>" name="phone" placeholder="" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                    </div>

                    <div class="md:w-80">
                        <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">LINE ID</label>
                        <input type="text" value="<?php echo $profileEdit['lineID']?>" name="lineID"  class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                    </div>

                    <div class="md:col-span-2 md:w-full">
                    <?php
                        if(substr($profileEdit['birthdate'], -5, 2) == '01'){
                            $month = 'มกราคม';
                        }elseif(substr($profileEdit['birthdate'], -5, 2) == '02'){
                            $month = 'กุมภาพันธ์';
                        }elseif(substr($profileEdit['birthdate'], -5, 2) == '03'){
                            $month = 'มีนาคม';
                        }elseif(substr($profileEdit['birthdate'], -5, 2) == '04'){
                            $month = 'เมษายน';
                        }elseif(substr($profileEdit['birthdate'], -5, 2) == '05'){
                            $month = 'พฤษภาคม';
                        }elseif(substr($profileEdit['birthdate'], -5, 2) == '06'){
                            $month = 'มิถุนายน';
                        }elseif(substr($profileEdit['birthdate'], -5, 2) == '07'){
                            $month = 'กรกฎาคม';
                        }elseif(substr($profileEdit['birthdate'], -5, 2) == '08'){
                            $month = 'สิงหาคม';
                        }elseif(substr($profileEdit['birthdate'], -5, 2) == '09'){
                            $month = 'กันยายน';
                        }elseif(substr($profileEdit['birthdate'], -5, 2) == '10'){
                            $month = 'ตุลาคม';
                        }elseif(substr($profileEdit['birthdate'], -5, 2) == '11'){
                            $month = 'พฤศจิกายน';
                        }elseif(substr($profileEdit['birthdate'], -5, 2) == '12'){
                            $month = 'ธันวาคม';
                        }else{
                            return false;
                        }
                    
                    ?>
                        <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">วัน/เดือน/ปีเกิด</label>
                        <span>
                            <select name="day" readonly class="py-3 px-3 mr-3 text-gray-700 placeholder-gray-400 bg-gray-100 border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700">
                                <option value=""><?php echo substr($profileEdit['birthdate'], -2) ?></option>
                            </select> 
                        </span>
                        <span>
                            <select name="month" readonly class="py-3 px-3 mr-3 text-gray-700 placeholder-gray-400 bg-gray-100 border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700">
                                <option value=""><?php echo $month ?></option>
                            </select>
                        </span>
                        <span>
                            <select name="year" readonly class="py-3 px-3 mr-3 text-gray-700 placeholder-gray-400 bg-gray-100 border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700">
                                <option value=""><?php echo substr($profileEdit['birthdate'], -10, 4) ?></option>
                            </select>
                        </span>
                    </div>

                    <div class="md:col-span-2 md:w-80">
                        <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">เพศ</label>
                            <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="male" <?php echo ($profileEdit['gender']=='male')?'checked':'' ?> required>
                                <span class="ml-2">ชาย</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="gender" value="female" <?php echo ($profileEdit['gender']=='female')?'checked':'' ?> required>
                                <span class="ml-2">หญิง</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="gender" value="trans" <?php echo ($profileEdit['gender']=='trans')?'checked':'' ?> required>
                                <span class="ml-2">อื่นๆ</span>
                            </label>
                            </div>
                    </div>

                    <div class="mb-6 mt-6">
                        <img loading="lazy" src="uploads/profiles/<?php echo $profileEdit['img']; ?>" width="30%" id="previewImgProfile" alt="profile"
                        class="w-32 h-32 rounded-full mx-auto"
                        >
                    </div>
                    <div class="flex justify-center items-center">
                    <label for="imgInputProfile" class="flex flex-col justify-center items-center w-full h-32 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col justify-center items-center pt-5 pb-6">
                            <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">คลิก เพื่อเปลี่ยนรูปโปรไฟล์</span></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or JPEG</p>
                        </div>
                            <input accept="image/png, image/jpeg, image/jpg"  id="imgInputProfile" name="img" type="file" class="hidden" />
                        </label>
                    </div> 

                    <button
                        type="submit"
                        name="profileEdit"
                        class="flex items-center justify-between w-full px-6 py-3 text-sm tracking-wide text-white capitalize transition-colors duration-300 transform bg-primary rounded-md hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        <span>แก้ไข</span>
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
    <!-- <script src="assets/js/datePickEdit.js"></script> -->
    <script src="assets/js/main.js"></script>

    <script>
        let imgInputProfile = document.getElementById('imgInputProfile');
        let previewImgProfile = document.getElementById('previewImgProfile');

        imgInputProfile.onchange = evt => {
            const [file] = imgInputProfile.files;
                if (file) {
                    previewImgProfile.src = URL.createObjectURL(file)
            }

        
        }
    </script>

    
  </body>
</html>
