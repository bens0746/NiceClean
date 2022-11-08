<?php 
    session_start();
    require_once "config/db.php";
?>

<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>สมัครสมาชิก | NiceClean</title>
    <link
      rel="shortcut icon"
      href="assets/images/favicon.png"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/tailwind.css" />

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <!-- Mobiscroll JS and CSS Includes -->
    <link rel="stylesheet" href="assets/css/mobiscroll.jquery.min.css">
    <script src="assets/js/mobiscroll.jquery.min.js"></script>

    <!-- ==== WOW JS ==== -->
    <script src="assets/js/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>
  </head>
  <body>
    <!-- ====== Header Start ====== -->
    <?php include './includes/style.php';?>
    <!-- ====== Header End ====== -->

    <!-- ====== Forms Section Start -->
    <section class="bg-white dark:bg-gray-900">
      <div class="flex justify-center min-h-screen">
        <a class="hidden bg-fixed lg:block lg:w-2/5" style="background-image: url('./assets/images/BG_register.png')"></a>
        </a>

          <div class="wow fadeInUp flex items-center w-full max-w-3xl p-8 mx-auto lg:px-12 lg:w-3/5" data-wow-delay=".1s">
              <div class="w-full">
                <a
                  href="/niceclean"
                  class="inline-block max-w-[160px]"
                >
                  <img src="assets/images/logo/logo.svg" alt="logo" class="w-full mx-auto"/>
                </a>
                  <h1 class="text-2xl font-semibold tracking-wider text-gray-800 capitalize dark:text-white">
                    สมัครฟรีที่นี่
                  </h1>

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
                        <span class="font-medium">
                          <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                          ?>
                        </span>
                      </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['warning'])) { ?>
                      <div class="flex p-4 mb-4 bg-yellow-100 rounded-lg dark:bg-yellow-200" role="alert">
                        <?php
                          echo $_SESSION['warning'];
                          unset($_SESSION['warning']);
                        ?>
                      </div>
                    <?php } ?>
                  <div class="error-text"></div>

                  <div class="mt-6">
                      <h1 class="text-gray-500 dark:text-gray-300">ประเภทของบัญชี</h1>

                      <div class="mt-3 md:flex md:items-center md:-mx-2">
                          <button id="userForm" class="flex justify-center w-full px-6 py-3 text-white bg-primary rounded-md md:w-auto md:mx-2 focus:outline-none">
                              <svg svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                              </svg>
                              <span class="mx-2">
                                ลูกค้า
                              </span>
                          </button>

                          <button id="cleanerForm" class="flex justify-center transform motion-safe:hover:scale-105 transition w-full px-6 py-3 mt-4 text-primary border border-primary rounded-md md:mt-0 md:w-auto md:mx-2 dark:border-blue-400 dark:text-blue-400 focus:outline-none">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                              </svg>
                              <span class="mx-2">
                                พนักงานทำความสะอาด
                              </span>
                          </button>
                      </div>
                  </div>
                <div id="USER">
                <label class="mt-2 text-2xl text-gray-800 dark:text-gray-200 flex">สมัครบัญชี สามาชิก</label>
                  <form action="signup_db.php" method="POST"  enctype="multipart/form-data" class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
                      <div class="md:col-span-2 md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">อีเมล <p class="text-red-500">*</p></label>
                          <input type="email" name="email" placeholder="กรอกอีเมล" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>

                      <div class="md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">รหัสผ่าน <p class="text-red-500">*</p></label>
                          <input type="password" name="password" placeholder="กรอกรหัสผ่าน" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>

                      <div class="md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">ยืนยันรหัสผ่าน <p class="text-red-500">*</p></label>
                          <input type="password" name="c_password" placeholder="กรอกรหัสผ่านยืนยัน" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>

                      <div class="md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">ชื่อจริง <p class="text-red-500">*</p></label>
                          <input type="text" name="firstname" placeholder="กรอกชื่อ" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>

                      <div class="md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">นามสกุล <p class="text-red-500">*</p></label>
                          <input type="text" name="lastname" placeholder="กรอกนามสกุล" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>

                      <div class="md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">เบอร์โทรศัพท์ <p class="text-red-500">*</p></label>
                          <input type="text" name="phone" placeholder="กรอกเบอร์โทร" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>

                      <div class="md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">LINE ID</label>
                          <input type="text" name="lineID" placeholder="กรอกไลน์ไอดี" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>
                      
                      <div class="md:col-span-2 md:w-full">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">วัน/เดือน/ปีเกิด <p class="text-red-500">*</p></label>
                          <span>
                              <select name="day" id="day" required class="py-3 px-3 mr-3 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700"> </select>
                          </span>
                          <span>
                              <select name="month" id="month" required class="py-3 px-3 mr-3 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700"> </select>
                          </span>
                          <span>
                              <select name="year" id="year" required class="py-3 px-3 mr-3 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700"> </select>
                          </span>
                      </div>

                      <div class="md:col-span-2 md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">เพศ <p class="text-red-500">*</p></label>
                            <div class="mt-2">
                              <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="male" required>
                                <span class="ml-2">ชาย</span>
                              </label>
                              <label class="inline-flex items-center ml-6">
                                <input type="radio" name="gender" value="female" required>
                                <span class="ml-2">หญิง</span>
                              </label>
                              <label class="inline-flex items-center ml-6">
                                <input type="radio" name="gender" value="trans" required>
                                <span class="ml-2">อื่นๆ</span>
                              </label>
                            </div>
                      </div>
                    
                      <div class="md:w-80">
                      <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">รูปโปรไฟล์ <p class="text-red-500">*</p></label>
                        <div class="flex justify-center items-center">
                          <label for="imgInputProfile" class="flex flex-col justify-center items-center w-full h-32 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                              <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                  <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                  <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">คลิก เพื่อเพิ่มรูปโปรไฟล์</span></p>
                                  <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or JPEG</p>
                              </div>
                                <input accept="image/png, image/jpeg, image/jpg" required  id="imgInputProfile" name="img" type="file" class="hidden" />
                            </label>
                        </div>
                      </div>
                       
                      <div class="mb-6 mt-6">
                        <label for="imgInputProfile" class="flex flex-col justify-center items-center w-32 h-32  mx-auto bg-gray-50 rounded-full border-2 border-gray-300 cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                          <img loading="lazy" src="assets/images/example/nouser.jpg" width="50%" id="previewImgProfile" alt=""
                          class="w-32 h-32 rounded-full mx-auto"
                          >
                        </label>
                      </div>

                      <div class="g-recaptcha md:col-span-2" data-sitekey="6Lfx55ciAAAAABQO4bdX5r7oC5lfzk7DGIt-7enq">

                      </div>

                      <button
                          type="submit"
                          name="signup"
                          class="flex items-center justify-between w-full px-6 py-3 text-sm tracking-wide text-white capitalize transition-colors duration-300 transform bg-primary rounded-md hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                          <span>สมัครสมาชิก</span>
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd" />
                          </svg>
                      </button>
                  </form>
                </div>

                
                <div id="CLEANER" style="display:none">
                <label class="mt-2 text-2xl text-gray-800 dark:text-gray-200 flex">สมัครบัญชี พนักงานทำความสะอาด</label>
                  <form action="signup_db.php" method="POST"  enctype="multipart/form-data" class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
                      <div class="md:col-span-2 md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">อีเมล <p class="text-red-500">*</p></label>
                          <input type="email" name="email" placeholder="กรอกอีเมล" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>

                      <div class="md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">รหัสผ่าน <p class="text-red-500">*</p></label>
                          <input type="password" name="password" placeholder="กรอกรหัสผ่าน" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>

                      <div class="md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">ยืนยันรหัสผ่าน <p class="text-red-500">*</p></label>
                          <input type="password" name="c_password" placeholder="กรอกรหัสผ่านยืนยัน" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>

                      <div class="md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">ชื่อจริง <p class="text-red-500">*</p></label>
                          <input type="text" name="firstname" placeholder="กรอกชื่อ" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>

                      <div class="md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">นามสกุล <p class="text-red-500">*</p></label>
                          <input type="text" name="lastname" placeholder="กรอกนามสกุล" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>

                      <div class="md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">เบอร์โทรศัพท์ <p class="text-red-500">*</p></label>
                          <input type="text" name="phone" placeholder="กรอกเบอร์โทร" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>

                      <div class="md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">LINE ID<p class="text-red-500">*</p></label>
                          <input type="text" name="lineID" placeholder="กรอกไลน์ไอดี" required class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      </div>
                      
                      <div class="md:col-span-2 md:w-full">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">วัน/เดือน/ปีเกิด <p class="text-red-500">*</p></label>
                          <span>
                              <select name="day" id="dayC" required class="py-3 px-3 mr-3 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700"> </select>
                          </span>
                          <span>
                              <select name="month" id="monthC" required class="py-3 px-3 mr-3 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700"> </select>
                          </span>
                          <span>
                              <select name="year" id="yearC" required class="py-3 px-3 mr-3 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700"> </select>
                          </span>
                      </div>

                      <div class="md:col-span-2 md:w-80">
                          <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">เพศ <p class="text-red-500">*</p></label>
                            <div class="mt-2">
                              <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="male" required>
                                <span class="ml-2">ชาย</span>
                              </label>
                              <label class="inline-flex items-center ml-6">
                                <input type="radio" name="gender" value="female" required>
                                <span class="ml-2">หญิง</span>
                              </label>
                              <label class="inline-flex items-center ml-6">
                                <input type="radio" name="gender" value="trans" required>
                                <span class="ml-2">อื่นๆ</span>
                              </label>
                            </div>
                      </div>
                      
                      <div class="md:w-80">
                      <label class="mb-2 text-sm text-gray-600 dark:text-gray-200 flex">รูปโปรไฟล์ <p class="text-red-500">*</p></label>
                        <div class="flex justify-center items-center">
                          <label for="imgInputProfile2" class="flex flex-col justify-center items-center w-full h-32 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                              <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                  <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                  <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">คลิก เพื่อเพิ่มรูปโปรไฟล์</span></p>
                                  <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or JPEG</p>
                              </div>
                                <input accept="image/png, image/jpeg, image/jpg" required  id="imgInputProfile2" name="img" type="file" class="hidden" />
                            </label>
                        </div>
                      </div>
                      <div class="mb-6 mt-6">
                        <label for="imgInputProfile2" class="flex flex-col justify-center items-center w-32 h-32  mx-auto bg-gray-50 rounded-full border-2 border-gray-300 cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                          <img loading="lazy" src="assets/images/example/nouser.jpg" width="50%" id="previewImgProfile2" alt=""
                          class="w-32 h-32 rounded-full mx-auto"
                          >
                        </label>
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

                      <div class="g-recaptcha md:col-span-2" data-sitekey="6Lfx55ciAAAAABQO4bdX5r7oC5lfzk7DGIt-7enq">

                      </div>

                      <button
                          type="submit"
                          name="signup_cleaner"
                          class="flex items-center justify-between w-full px-6 py-3 text-sm tracking-wide text-white capitalize transition-colors duration-300 transform bg-primary rounded-md hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                          <span>สมัครสมาชิก</span>
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd" />
                          </svg>
                      </button>
                  </form>
                </div>
                  <p class="text-base text-[#adadad]">
                    มีบัญชีอยู่แล้ว ?
                    <a href="signin.php" class="text-primary hover:underline">
                    เข้าสู่ระบบ
                    </a>
                  </p>
              </div>
          </div>
      </div>
    </section>
    
    <!-- ====== Forms Section End -->


    <!-- ====== Back To Top Start -->
    <a
      href="javascript:void(0)"
      class="back-to-top fixed bottom-8 right-8 left-auto z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark"
    >
      <span
        class="mt-[6px] h-3 w-3 rotate-45 border-t border-l border-white"
      ></span>
    </a>
    <!-- ====== Back To Top End -->

    <!-- ====== All Scripts -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/datePick.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
        let imgInputProfile = document.getElementById('imgInputProfile');
        let previewImgProfile = document.getElementById('previewImgProfile');

        imgInputProfile.onchange = evt => {
            const [file] = imgInputProfile.files;
                if (file) {
                    previewImgProfile.src = URL.createObjectURL(file)
            }

        
        }

        let imgInputProfile2 = document.getElementById('imgInputProfile2');
        let previewImgProfile2 = document.getElementById('previewImgProfile2');

        imgInputProfile2.onchange = evt => {
            const [file] = imgInputProfile2.files;
                if (file) {
                    previewImgProfile2.src = URL.createObjectURL(file)
            }

        
        }

        let imgInputProof = document.getElementById('imgInputProof');
        let previewImgProof = document.getElementById('previewImgProof');

        imgInputProof.onchange = evt => {
            const [file] = imgInputProof.files;
                if (file) {
                    previewImgProof.src = URL.createObjectURL(file)
            }

        
        }

    </script>

    <script>
      document.getElementById("cleanerForm").onclick = function() {
  
        document.getElementById("USER").style.display = "none";
        document.getElementById("CLEANER").style.display = "";
        document.getElementById("cleanerForm").className ="flex justify-center w-full px-6 py-3 mt-4 text-white bg-primary rounded-md md:mt-0 md:w-auto md:mx-2 dark:border-blue-400 dark:text-blue-400 focus:outline-none";
        document.getElementById("userForm").className ="flex justify-center transform motion-safe:hover:scale-105 transition w-full px-6 py-3 mt-4 text-primary border border-primary rounded-md md:mt-0 md:w-auto md:mx-2 dark:border-blue-400 dark:text-blue-400 focus:outline-none";
      }

      document.getElementById("userForm").onclick = function() {

        document.getElementById("CLEANER").style.display = "none";
        document.getElementById("USER").style.display = "";
        document.getElementById("userForm").className ="flex justify-center w-full px-6 py-3 mt-4 text-white bg-primary rounded-md md:mt-0 md:w-auto md:mx-2 dark:border-blue-400 dark:text-blue-400 focus:outline-none";
        document.getElementById("cleanerForm").className ="flex justify-center transform motion-safe:hover:scale-105 transition w-full px-6 py-3 mt-4 text-primary border border-primary rounded-md md:mt-0 md:w-auto md:mx-2 dark:border-blue-400 dark:text-blue-400 focus:outline-none";
      }
    </script>
  </body>
</html>
