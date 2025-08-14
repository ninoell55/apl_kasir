<?php require_once "../../includes/header.php";  ?>


<body class=" bg-surface">
  <main>
    <?php require_once "../../includes/navbar.php";  ?>

    <!--start the project-->
    <div id="main-wrapper" class=" flex p-5 xl:pr-0 min-h-screen">

      <?php require_once "../../includes/sidebar.php";  ?>

      <div class=" w-full page-wrapper xl:px-6 px-0 ">

        <!-- Main Content -->
        <main class="h-full  max-w-full">
          <div class="container full-container p-0 flex flex-col gap-6">
            <!--  Header Start -->
            <header class=" bg-white shadow-md rounded-md w-full text-sm py-4 px-6">


              <!-- ========== HEADER ========== -->

              <nav class=" w-ful flex items-center justify-between" aria-label="Global">
                <ul class="icon-nav flex items-center gap-4">
                  <li class="relative xl:hidden">
                    <a class="text-xl  icon-hover cursor-pointer text-heading"
                      id="headerCollapse" data-hs-overlay="#application-sidebar-brand"
                      aria-controls="application-sidebar-brand" aria-label="Toggle navigation" href="javascript:void(0)">
                      <i class="ti ti-menu-2 relative z-1"></i>
                    </a>
                  </li>

                  <li class="relative">

                    <div class="hs-dropdown relative inline-flex [--placement:bottom-left] sm:[--trigger:hover]">
                      <a class="relative hs-dropdown-toggle inline-flex hover:text-gray-500 text-gray-300" href="#">
                        <i class="ti ti-bell-ringing text-xl relative z-[1]"></i>
                        <div
                          class="absolute inline-flex items-center justify-center  text-white text-[11px] font-medium  bg-blue-600 w-2 h-2 rounded-full -top-[1px] -right-[6px]">
                        </div>
                      </a>
                      <div class="card hs-dropdown-menu transition-[opacity,margin] rounded-md duration hs-dropdown-open:opacity-100 opacity-0 mt-2 min-w-max  w-[300px] hidden z-[12]"
                        aria-labelledby="hs-dropdown-custom-icon-trigger">
                        <div>
                          <h3 class="text-gray-500 font-semibold text-base px-6 py-3">Notification</h3>
                          <ul class="list-none  flex flex-col">
                            <li>
                              <a href="#" class="py-3 px-6 block hover:bg-gray-200">
                                <p class="text-sm text-gray-500 font-medium">Roman Joined the Team!</p>
                                <p class="text-xs text-gray-400 font-medium">Congratulate him</p>
                              </a>
                            </li>
                            <li>
                              <a href="#" class="py-3 px-6 block hover:bg-gray-200">
                                <p class="text-sm text-gray-500 font-medium">New message received</p>
                                <p class="text-xs text-gray-400 font-medium">Salma sent you new message</p>
                              </a>
                            </li>
                            <li>
                              <a href="#" class="py-3 px-6 block hover:bg-gray-200">
                                <p class="text-sm text-gray-500 font-medium">New Payment received</p>
                                <p class="text-xs text-gray-400 font-medium">Check your earnings</p>
                              </a>
                            </li>
                            <li>
                              <a href="#" class="py-3 px-6 block hover:bg-gray-200">
                                <p class="text-sm text-gray-500 font-medium">Jolly completed tasks</p>
                                <p class="text-xs text-gray-400 font-medium">Assign her new tasks</p>
                              </a>
                            </li>
                            <li>
                              <a href="#" class="py-3 px-6 block hover:bg-gray-200">
                                <p class="text-sm text-gray-500 font-medium">Roman Joined the Team!</p>
                                <p class="text-xs text-gray-400 font-medium">Congratulate him</p>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>

                  </li>
                </ul>
                <div class="flex items-center gap-4">
                  <a href="https://www.wrappixel.com/templates/spike-free-tailwind-admin-template/" class="btn text-base font-medium hover:bg-blue-700" target="_blank" aria-current="page">Download Free</a>
                  <div class="hs-dropdown relative inline-flex [--placement:bottom-right] sm:[--trigger:hover]">
                    <a class="relative hs-dropdown-toggle cursor-pointer align-middle rounded-full">
                      <img class="object-cover w-9 h-9 rounded-full" src="../assets/images/profile/user-1.jpg" alt=""
                        aria-hidden="true">
                    </a>
                    <div class="card hs-dropdown-menu transition-[opacity,margin] rounded-md duration hs-dropdown-open:opacity-100 opacity-0 mt-2 min-w-max  w-[200px] hidden z-[12]"
                      aria-labelledby="hs-dropdown-custom-icon-trigger">
                      <div class="card-body p-0 py-2">
                        <a href="javscript:void(0)" class="flex gap-2 items-center font-medium px-4 py-1.5 hover:bg-gray-200 text-gray-400">
                          <i class="ti ti-user  text-xl "></i>
                          <p class="text-sm ">My Profile</p>
                        </a>
                        <a href="javscript:void(0)" class="flex gap-2 items-center font-medium px-4 py-1.5 hover:bg-gray-200 text-gray-400">
                          <i class="ti ti-mail  text-xl"></i>
                          <p class="text-sm ">My Account</p>
                        </a>
                        <a href="javscript:void(0)" class="flex gap-2 items-center font-medium px-4 py-1.5 hover:bg-gray-200 text-gray-400">
                          <i class="ti ti-list-check  text-xl "></i>
                          <p class="text-sm ">My Task</p>
                        </a>
                        <div class="px-4 mt-[7px] grid">
                          <a href="../../pages/authentication-login.html" class="btn-outline-primary font-medium text-[15px] w-full hover:bg-blue-600 hover:text-white">Logout</a>
                        </div>

                      </div>
                    </div>
                  </div>


                </div>
              </nav>

              <!-- ========== END HEADER ========== -->
            </header>
            <!--  Header End -->
            <div class="card">
              <div class="card-body">
                <div
                  class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
                  <div class="flex flex-col gap-6">
                    <h6 class="text-lg text-gray-500 font-semibold">Card</h6>
                    <div class="card overflow-hidden">
                      <div class=" bg-white">
                        <img class="w-full h-auto rounded-t-xl"
                          src="../assets/images/products/product-1.jpg"
                          alt="Image Description">
                        <div class="card-body">
                          <h3 class="text-lg font-medium text-gray-500">
                            Card title
                          </h3>
                          <p class="mt-1 text-sm text-gray-400">
                            Some quick example text to build on the card title and
                            make up the bulk of the card's content.
                          </p>
                          <a href="#" class="text-base inline-block font-semibold hover:bg-blue-700 btn mt-4 py-2.5">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-col gap-6">
                    <h6 class="text-lg text-gray-500 font-semibold">Header and footer</h6>
                    <div class="card">
                      <div class="py-4 px-7 ">
                        <p class="mt-1 text-sm text-gray-400">
                          Featured
                        </p>
                      </div>
                      <div class="card-body">
                        <h3 class="text-lg font-medium text-gray-500">
                          Special title treatment
                        </h3>
                        <p class="mt-1 text-sm text-gray-400">
                          With supporting text below as a natural lead-in to
                          additional content.
                        </p>
                        <a href="#" class="text-base inline-block font-semibold hover:bg-blue-700 btn mt-4 py-2.5">Go somewhere</a>
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-col gap-6">
                    <h6 class="text-lg text-gray-500 font-semibold">Titles, text, and links
                    </h6>
                    <div class="card">
                      <div class="card-body">
                        <div class="flex flex-col">
                          <h3 class="text-lg font-medium text-gray-500">
                            Card title
                          </h3>
                          <p
                            class=" text-sm text-gray-400 opacity-80">
                            Card subtitle
                          </p>
                          <p class="mt-2 text-sm text-gray-400">
                            Some quick example text to build on the card title and
                            make up the bulk of the card's content.
                          </p>
                          <div class="flex gap-2">
                            <a class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-700"
                              href="#">
                              Card link
                              <i class="ti ti-chevron-right text-base"></i>
                            </a>
                            <a class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-700"
                              href="#">
                              Another link
                              <i class="ti ti-chevron-right text-base"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </main>
        <!-- Main Content End -->

      </div>
    </div>
    <!--end of project-->
  </main>



  <?php require_once "../../includes/footer.php";  ?>