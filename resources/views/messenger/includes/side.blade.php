<!-- Sidebar -->
<aside class="sidebar bg-light">
    <div class="tab-content h-100" role="tablist">
        <!-- Create -->

        <div class="tab-pane fade h-100 show active" id="tab-content-friends" role="tabpanel">
            <div class="d-flex flex-column h-100">
                <div class="hide-scrollbar">
                    <div class="container py-8">

                        <!-- Title -->
                        <div class="mb-8">
                            <h2 class="fw-bold m-0">Users</h2>
                        </div>

                        <!-- Search -->
                        <div class="mb-6">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="icon icon-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </div>
                                </div>

                                <input type="text" class="form-control form-control-lg ps-0"
                                    placeholder="Search messages or users" id="users-search"
                                    aria-label="Search for messages or users...">
                            </div>
                        </div>

                        <!-- List -->
                        <div class="card-list users-list"></div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Chats -->
        <div class="tab-pane fade h-100" id="tab-content-chats" role="tabpanel">
            <div class="d-flex flex-column h-100 position-relative">
                <div class="hide-scrollbar">

                    <div class="container py-8">
                        <!-- Title -->
                        <div class="mb-8">
                            <h2 class="fw-bold m-0">Chats</h2>
                        </div>

                        <!-- Search -->
                        <div class="mb-6">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="icon icon-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </div>
                                </div>

                                <input type="text" class="form-control form-control-lg ps-0"
                                    placeholder="Search messages or users" id="search"
                                    aria-label="Search for messages or users...">
                            </div>
                        </div>

                        <!-- Chats -->
                        <div class="card-list conversations-list"></div>
                        <!-- Chats -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</aside>
<!-- Sidebar -->
