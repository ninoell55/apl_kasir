<?php require_once "../../includes/header.php";  ?>


<body class=" bg-surface">
  <main>

<?php require_once "../../includes/navbar.php";  ?>

    <!--start the project-->
    <div id="main-wrapper" class=" flex p-5 xl:pr-0 min-h-screen">

<?php require_once "../../includes/sidebar.php";  ?>

      <div class=" w-full page-wrapper xl:px-6 px-0">

        <!-- Main Content -->
        <main class="h-full max-w-full">
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
              <div class="card-body flex flex-col gap-6">
                <h6 class="text-lg text-gray-500 font-semibold">Headings</h6>
                <div class="card">
                  <div class="card-body text-gray-500 flex flex-col gap-1">
                    <h1 class="text-4xl">h1. Preline heading</h1>
                    <h2 class="text-3xl">h2. Preline heading</h2>
                    <h3 class="text-2xl">h3. Preline heading</h3>
                    <h4 class="text-xl">h4. Preline heading</h4>
                    <h5 class="text-lg">h5. Preline heading</h5>
                    <h6 class="text-base">h6. Preline heading</h6>
                  </div>
                </div>
                <h6 class="text-lg text-gray-500 font-semibold">Inline text elements</h6>
                <div class="card">
                  <div class="card-body text-gray-400 flex flex-col gap-1">
                    <p>You can use the mark tag to <mark>highlight</mark>
                      text.</p>
                    <p><del>This line of text is meant to be treated as
                        deleted text.</del></p>
                    <p><s>This line of text is meant to be treated as no
                        longer accurate.</s></p>
                    <p><ins>This line of text is meant to be treated as an
                        addition to the document.</ins></p>
                    <p><u>This line of text will render as underlined.</u>
                    </p>
                    <p><small>This line of text is meant to be treated as
                        fine print.</small></p>
                    <p><strong>This line rendered as bold text.</strong></p>
                    <p><em>This line rendered as italicized text.</em></p>
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
