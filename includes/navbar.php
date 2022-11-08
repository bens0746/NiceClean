<?php require_once "config/db.php";?>
<?php include("includes/style.php")?>
<?php include("includes/shapeStyle.php") ?>
<?php include("check_login.php") ?>

<!-- ====== Navbar Section Start -->
<div class="ud-header absolute top-0 left-0 z-40 flex w-full items-center bg-transparent">
  <div class="container">
    <div class="relative -mx-4 flex items-center justify-between">
      <div class="w-60 max-w-full px-4">
        <a href="/niceclean" class="navbar-logo block w-full py-5">
          <img
            src="assets/images/logo/logo-white.svg"
            alt="logo"
            class="header-logo"
          />
        </a>
      </div>
      <div class="hidden justify-end pr-16 sm:flex lg:pr-0">
        <form action="post_search.php" method="GET">   
          <div class="items-center justify-between w-full flex rounded-full shadow-lg p-2 my-1 bg-primary bg-opacity-50">
            <input class="font-bold rounded-full w-36 py-4 pl-4 text-gray-700 bg-gray-100 leading-tight focus:outline-none focus:shadow-outline lg:text-sm text-xs" 
            type="text" 
            placeholder="ค้นหา"
            name="search_text"
            >
            <button class="bg-gray-600 p-2 hover:bg-blue-400 cursor-pointer mx-2 rounded-full">
              <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </form>
      </div>
      <div class="flex w-full items-center justify-between px-4">
        <div id="navbarScroll">
          <nav
            class="absolute left-4 top-full hidden w-full max-w-[250px] rounded-lg bg-white py-5 shadow-lg lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent lg:py-0 lg:px-4 lg:shadow-none xl:px-6"
          >
            <ul class="blcok lg:flex">
              <li class="group relative">
                <a
                  href="post_grids.php"
                  class="ud-menu-scroll mx-8 flex py-2 text-base text-dark group-hover:text-primary lg:mr-0 lg:ml-7 lg:inline-flex lg:py-6 lg:px-0 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-12"
                >
                  โพสต์ทั้งหมด
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <div>
          <div class="md:hidden lg:hidden">
            <a
              href="signup.php"
              class="signUpBtn mr-16 flex items-center rounded-lg bg-white bg-opacity-20 py-3 px-6 my-2 text-base font-medium text-white duration-300 ease-in-out hover:bg-opacity-100 hover:text-dark"
            >
              สมัครสมาชิก
            </a>
          </div>
          <div class="lg:hidden">
          <button
              id="navbarToggler"
              class="absolute right-4 top-1/2 block -translate-y-1/2 rounded-lg px-3 py-[6px] ring-primary focus:ring-2"
            >
              <span
                class="relative my-[6px] block h-[2px] w-[30px] bg-white"
              ></span>
              <span
                class="relative my-[6px] block h-[2px] w-[30px] bg-white"
              ></span>
              <span
                class="relative my-[6px] block h-[2px] w-[30px] bg-white"
              ></span>
            </button>
          </div>
            
          <nav
            id="navbarCollapse"
            class="absolute right-4 top-full hidden w-full max-w-[250px] rounded-lg bg-white py-5 shadow-lg lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent lg:py-0 lg:px-4 lg:shadow-none xl:px-6"
          >
            <ul class="blcok lg:flex">
              <li class="group relative">
                <a
                  href="signin.php"
                  class="ud-menu-scroll mx-8 flex py-2 text-base text-dark group-hover:text-primary lg:hidden xl:ml-12"
                >
                  เข้าสู่ระบบ
                </a>
                <a
                  href="post_grids.php"
                  class="ud-menu-scroll mx-8 flex py-2 text-base text-dark group-hover:text-primary lg:hidden xl:ml-12"
                >
                  โพสต์
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="hidden justify-end pr-16 sm:flex lg:pr-0">
          <a
            href="signin.php"
            class="loginBtn flex items-center py-3 px-7 my-2 text-base font-medium text-white hover:opacity-70"
          >
            เข้าสู่ระบบ
          </a>
          <a
            href="signup.php"
            class="signUpBtn flex items-center rounded-lg bg-white bg-opacity-20 py-3 px-6 my-2 text-base font-medium text-white duration-300 ease-in-out hover:bg-opacity-100 hover:text-dark"
          >
            สมัครสมาชิก
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ====== Navbar Section End -->