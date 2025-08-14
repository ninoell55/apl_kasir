<?php require_once "../../includes/header.php";  ?>


<body class=" bg-surface">
  <main>

<?php require_once "../../includes/navbar.php";  ?>

    <!--start the project-->
    <div id="main-wrapper" class=" flex p-5 xl:pr-0 min-h-screen">

<?php require_once "../../includes/sidebar.php";  ?>

      <div class=" w-full page-wrapper xl:px-6 px-0">

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
              <div class="card-body flex flex-col gap-6">
                <h6 class="text-lg text-gray-500 font-semibold">Forms</h6>
                <div class="card">
                  <div class="card-body">
                    <form>
                      <div class="mb-6">
                        <label for="input-label-with-helper-text"
                          class="block text-sm mb-2 text-gray-400">Email address</label>
                        <input type="email" id="input-label-with-helper-text"
                          class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                          placeholder="you@site.com" aria-describedby="hs-input-helper-text">
                        <p class="text-sm  text-gray-400 opacity-75 mt-2" id="hs-input-helper-text">We'll never share your email with anyone else.</p>
                      </div>
                      <div class="mb-6">
                        <label for="input-label-with-helper-text"
                          class="block text-sm mb-2 text-gray-400">Password</label>
                        <input type="password" id="input-label-with-helper-text"
                          class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                          placeholder="*******" aria-describedby="hs-input-helper-text">
                      </div>
                      <div class="flex mb-4">
                        <input type="checkbox" class="shrink-0 mt-0.5 border-gray-400 rounded-[4px] text-blue-600 focus:ring-blue-500 " id="hs-default-checkbox">
                        <label for="hs-default-checkbox" class="text-sm text-gray-400 ms-3">Check me out</label>
                      </div>
                      <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700">Submit</button>
                    </form>
                  </div>
                </div>
                <h6 class="text-lg text-gray-500 font-semibold">Disabled forms</h6>
                <div class="card">
                  <div class="card-body">
                    <h6 class="text-2xl text-gray-400 mb-4">Disabled fieldset example</h6>
                    <form action="" class="flex flex-col gap-4">
                      <div>
                        <label for="input-label-with-helper-text"
                          class="block text-sm mb-2 text-gray-400">Disabled input</label>
                        <input type="email" id="input-label-with-helper-text"
                          class="py-3 px-4 block w-full border-gray-200 text-sm rounded-sm  focus:border-blue-600 focus:ring-0 bg-gray-200 disabled:opacity-60  disabled:pointer-events-none disabled:shadow-xl"
                          placeholder="Disabled input" aria-describedby="hs-input-helper-text" disabled>
                      </div>
                      <div>
                        <label for="input-label-with-helper-text"
                          class="block text-sm mb-2 text-gray-400">Disabled select menu</label>
                        <select class="py-3 px-4 pe-9 block w-full disabled:bg-gray-200 placeholder:opacity-40 border-gray-200 rounded-sm text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:shadow-xl disabled:opacity-60" disabled>
                          <option selected>Disabled select</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                        </select>
                      </div>
                      <div class="flex opacity-60">
                        <input type="checkbox" class="shrink-0 mt-0.5 rounded-[4px] border-gray-400 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" id="hs-disabled-checkbox" disabled>
                        <label for="hs-disabled-checkbox" class="text-sm text-gray-500 ms-3 ">Can't check this</label>
                      </div>
                      <button class="btn py-2.5 text-base text-white font-medium w-fit hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" disabled>Submit</button>
                    </form>
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
