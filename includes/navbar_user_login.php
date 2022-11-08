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
        <form action="post_search.php" method="GET">   
          <div class="items-center justify-between w-full flex rounded-full shadow-lg p-2 mb-1 bg-primary bg-opacity-50">
            <input class="font-bold rounded-full w-36 py-4 px-4 text-gray-700 bg-gray-100 leading-tight focus:outline-none focus:shadow-outline lg:text-sm text-xs" 
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
              <li class="group relative">
                <a
                  href="mycalender.php"
                  class="ud-menu-scroll mx-8 flex py-2 text-base text-dark group-hover:text-primary lg:mr-0 lg:ml-7 lg:inline-flex lg:py-6 lg:px-0 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-12"
                >
                  ตารางงาน
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <div>

        <div class="md:hidden lg:hidden xs:hidden sm:hidden">
        <button
            id="navbarToggler2"
            class="absolute right-4 top-1/2 block -translate-y-1/2 rounded-lg px-3 py-[6px] ring-primary focus:ring-2 lg:hidden"
          >
            <img 
                src="uploads/profiles/<?php echo $row['img']; ?>" 
                alt="User"
                class="w-12 h-12 rounded-full mx-auto"
            />
          </button>
        </div>

          <!-- NAVBAR TOGGLE -->
          <nav
            id="navbarCollapse"
            class="absolute right-4 top-full hidden w-full max-w-[250px] rounded-lg bg-white py-5 shadow-lg lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent lg:py-0 lg:px-4 lg:shadow-none xl:px-6"
          >
            <ul class="blcok lg:flex">
              <li class="group relative">
                <a
                href="profile.php?user=<?php echo $row['user_id']?>"
                class="ud-menu-scroll mx-8 flex py-2 text-base text-dark group-hover:text-primary lg:hidden xl:ml-12"
                >
                ดูโปรไฟล์
                </a>
                <a
                class="ud-menu-scroll mx-8 flex py-2 text-base text-dark group-hover:text-primary lg:hidden xl:ml-12"
                >
                <?php echo $row['email']?>
                </a>
                <a
                class="ud-menu-scroll mx-8 flex py-2 text-base text-dark group-hover:text-primary lg:hidden xl:ml-12"
                >
                <?php echo $row['firstname'].' '.$row['lastname']?>
                </a>
                <a
                href="mycalender.php"
                class="ud-menu-scroll mx-8 flex py-2 text-base text-dark group-hover:text-primary lg:hidden xl:ml-12"
                >
                ตารางงาน
                </a>
                <a
                href="logout.php"
                class="ud-menu-scroll mx-8 flex py-2 text-base text-dark group-hover:text-primary lg:hidden xl:ml-12"
                >
                ออกจากระบบ
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="hidden justify-end pr-16 sm:flex lg:pr-0">
          <div class="block">
            <div class="submenu-item group relative content-center lg:ml-10 sm:ml-1 md:ml-2">
              <button id="navbarToggler" class="inline-flex items-center relative rounded-full shadow-lg">
                  <div class="block">
                      <img 
                      src="uploads/profiles/<?php echo $row['img']; ?>" 
                      alt="User"
                      class="w-12 h-12 rounded-full mx-auto"
                      />
                  </div>
                
              </button>
              <div class="submenu relative top-full left-0 hidden w-[240px] rounded-lg bg-white p-4 transition-[top] duration-300 group-hover:opacity-100 lg:invisible lg:absolute lg:top-[110%] lg:block lg:opacity-0 lg:shadow-lg lg:group-hover:visible lg:group-hover:top-full">   
                <a
                href="profile.php?user=<?php echo $row['user_id']?>"
                class="block rounded py-[10px] px-4 text-sm text-body-color hover:text-primary"
                >
                ดูโปรไฟล์
                </a>
                <a
                  class="block rounded py-[10px] px-4 text-sm text-body-color hover:text-primary"
                >
                <?php echo $row['email']?>
                </a>
                <a
                  class="block rounded py-[10px] px-4 text-sm text-body-color hover:text-primary"
                >
                <?php echo $row['firstname'].' '.$row['lastname']?>
                </a>
                <a
                  href="mycalender.php"
                  class="block rounded py-[10px] px-4 text-sm text-body-color hover:text-primary"
                >
                ตารางงาน
                </a>
                <a
                  href="logout.php"
                  class="block rounded py-[10px] px-4 text-sm text-body-color hover:text-primary"
                >
                ออกจากระบบ
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ====== Navbar Section End -->