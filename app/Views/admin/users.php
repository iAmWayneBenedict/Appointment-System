<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="mt-3 mb-5">
        <h2>Users</h2>

        <!-- breadcrumbs -->
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex flex-column">
        <div class="d-flex">
            <div class="d-flex gap-3 mb-5" style="height:fit-content">
                <div class="card" style="width: 18rem;">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="dashboard-icon bg-danger">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#84DCCF;" cx="255.997" cy="206.361" r="63.823"></circle> <path style="fill:#027EA8;" d="M256.001,142.534c-17.729,0-33.76,7.238-45.326,18.909c7.427-3.026,15.536-4.726,24.051-4.726 c35.25,0,63.825,28.575,63.825,63.824c0,17.52-7.069,33.382-18.498,44.915c23.32-9.501,39.773-32.364,39.773-59.099 C319.824,171.109,291.249,142.534,256.001,142.534z"></path> <path style="fill:#84DCCF;" d="M326.916,475.839H185.085V362.374c0-39.166,31.75-70.916,70.916-70.916l0,0 c39.166,0,70.916,31.75,70.916,70.916V475.839z"></path> <path style="fill:#027EA8;" d="M256.041,291.458c-11.08,0-23.216,2.614-32.558,7.144c38.678,0.565,68.179,32.051,68.179,70.863 v106.47h35.336V362.374C326.998,323.207,295.207,291.458,256.041,291.458z"></path> <circle style="fill:#FFFFFF;" cx="433.29" cy="99.979" r="63.823"></circle> <path style="fill:#E6E6E6;" d="M433.29,36.161c-17.729,0-33.76,7.238-45.326,18.909c7.427-3.026,15.536-4.726,24.051-4.726 c35.25,0,63.824,28.575,63.824,63.824c0,17.52-7.069,33.382-18.498,44.916c23.32-9.501,39.773-32.364,39.773-59.099 C497.114,64.736,468.539,36.161,433.29,36.161z"></path> <path style="fill:#FFFFFF;" d="M504.205,369.465H362.374V255.999c0-39.166,31.75-70.916,70.916-70.916l0,0 c39.166,0,70.916,31.75,70.916,70.916L504.205,369.465L504.205,369.465z"></path> <path style="fill:#E6E6E6;" d="M433.026,185.084c-11.08,0-23.368,2.614-32.711,7.144c38.678,0.565,68.027,32.051,68.027,70.863 v106.837h35.336V255.999C503.677,216.834,472.191,185.084,433.026,185.084z"></path> <circle style="fill:#FBB03B;" cx="78.705" cy="99.979" r="63.823"></circle> <path style="fill:#F15A24;" d="M78.71,36.161c-17.729,0-33.76,7.238-45.326,18.909c7.427-3.026,15.536-4.726,24.051-4.726 c35.25,0,63.824,28.575,63.824,63.824c0,17.52-7.069,33.382-18.498,44.916c23.32-9.501,39.772-32.364,39.772-59.099 C142.534,64.736,113.96,36.161,78.71,36.161z"></path> <path style="fill:#FBB03B;" d="M149.626,369.465H7.795V255.999c0-39.166,31.75-70.916,70.916-70.916l0,0 c39.166,0,70.916,31.75,70.916,70.916V369.465z"></path> <path style="fill:#F15A24;" d="M79.058,185.084c-11.08,0-23.582,2.614-32.925,7.144c38.678,0.565,67.813,32.051,67.813,70.863 v106.837h36.375V255.999C150.319,216.834,118.223,185.084,79.058,185.084z"></path> <path d="M256.001,277.977c-39.491,0-71.619-32.129-71.619-71.619s32.129-71.618,71.619-71.618s71.618,32.129,71.618,71.618 C327.619,245.85,295.491,277.977,256.001,277.977z M256.001,150.329c-30.895,0-56.03,25.135-56.03,56.029 c0,30.895,25.135,56.03,56.03,56.03s56.029-25.135,56.029-56.03C312.03,175.464,286.894,150.329,256.001,150.329z"></path> <path d="M334.71,483.634H177.289v-121.26c0-43.401,35.31-78.71,78.71-78.71s78.71,35.31,78.71,78.71V483.634z M192.878,468.044 h126.242V362.374c0-34.805-28.315-63.121-63.12-63.121c-34.806,0-63.121,28.316-63.121,63.121v105.671H192.878z"></path> <path d="M512,377.26H354.579V255.999c0-43.401,35.31-78.71,78.709-78.71c43.402,0,78.71,35.31,78.71,78.71V377.26H512z M370.168,361.671h126.242V255.999c0-34.805-28.315-63.121-63.12-63.121s-63.121,28.316-63.121,63.121v105.672H370.168z"></path> <path d="M157.421,377.26H0V255.999c0-43.401,35.31-78.71,78.71-78.71c43.402,0,78.71,35.31,78.71,78.71V377.26z M15.589,361.671 h126.242V255.999c0-34.805-28.316-63.121-63.121-63.121s-63.121,28.316-63.121,63.121V361.671z"></path> <g> <rect x="249.055" y="318.999" style="fill:#FFFFFF;" width="14.55" height="15.589"></rect> <rect x="249.055" y="347.06" style="fill:#FFFFFF;" width="14.55" height="15.589"></rect> <rect x="249.055" y="376.16" style="fill:#FFFFFF;" width="14.55" height="15.589"></rect> </g> <rect x="426.773" y="212.992" width="13.511" height="15.589"></rect> <rect x="426.773" y="241.052" width="13.511" height="15.589"></rect> <rect x="426.773" y="269.113" width="13.511" height="15.589"></rect> <g> <rect x="72.376" y="212.992" style="fill:#FFFFFF;" width="13.511" height="15.589"></rect> <rect x="72.376" y="241.052" style="fill:#FFFFFF;" width="13.511" height="15.589"></rect> <rect x="72.376" y="269.113" style="fill:#FFFFFF;" width="13.511" height="15.589"></rect> <path style="fill:#FFFFFF;" d="M306.344,206.76h-15.589c0-19.746-15.72-35.156-34.427-35.156v-15.589 C283.348,156.015,306.344,178.699,306.344,206.76z"></path> <path style="fill:#FFFFFF;" d="M289.565,243.881l-10.397-11.616c4.355-3.896,7.677-8.848,9.61-14.319l14.699,5.194 C300.673,231.072,295.863,238.244,289.565,243.881z"></path> </g> <path d="M78.71,171.604c-39.491,0-71.618-32.129-71.618-71.619c0-39.49,32.129-71.618,71.618-71.618 c39.491,0,71.619,32.129,71.619,71.618C150.329,139.476,118.201,171.604,78.71,171.604z M78.71,43.956 c-30.895,0-56.029,25.135-56.029,56.029c0,30.895,25.135,56.03,56.029,56.03c30.895,0,56.03-25.135,56.03-56.03 C134.74,69.091,109.605,43.956,78.71,43.956z"></path> <g> <path style="fill:#FFFFFF;" d="M129.055,99.713h-15.589c0-18.707-15.11-34.484-34.857-34.484V49.641 C106.669,49.641,129.055,72.692,129.055,99.713z"></path> <path style="fill:#FFFFFF;" d="M112.275,137.508l-10.397-11.616c4.353-3.896,7.676-8.848,9.61-14.32l14.699,5.195 C123.384,124.698,118.573,131.87,112.275,137.508z"></path> </g> <path d="M433.29,171.604c-39.491,0-71.618-32.129-71.618-71.619c0-39.49,32.128-71.618,71.618-71.618s71.619,32.129,71.619,71.618 C504.909,139.476,472.78,171.604,433.29,171.604z M433.29,43.956c-30.895,0-56.029,25.135-56.029,56.029 c0,30.895,25.135,56.03,56.029,56.03c30.895,0,56.03-25.135,56.03-56.03C489.32,69.091,464.184,43.956,433.29,43.956z"></path> <path d="M483.634,99.713h-15.589c0-18.707-15.292-34.484-35.039-34.484V49.641C461.067,49.641,483.634,72.692,483.634,99.713z"></path> <path d="M466.855,137.507l-10.397-11.615c4.354-3.897,7.676-8.85,9.61-14.321l14.699,5.196 C477.962,124.699,473.152,131.87,466.855,137.507z"></path> </g></svg>
                        </div>
                        <div>
                            <small class="card-title m-0">Registered Users</small>
                            <h3 class="m-0" id="registered"></h3>
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="dashboard-icon bg-success">
                            <svg height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#FC6F58;" cx="256" cy="256" r="256"></circle> <path style="fill:#F1543F;" d="M498.433,338.439L342.044,182.05l-17.086,10.735l-91.757-91.757l-19.149,37.747l-37.05,18.453 l78.924,78.924l-18.061,25.545L111.192,389.329l121.615,121.615C240.447,511.629,248.18,512,256,512 C368.542,512,464.119,439.377,498.433,338.439z"></path> <path style="fill:#90DFAA;" d="M208.798,352.068c0-53.498,43.368-96.866,96.866-96.866s96.866,43.368,96.866,96.866H208.798z"></path> <path style="fill:#2C9984;" d="M305.666,255.202c-0.083,0-0.164,0.005-0.247,0.007v96.861h97.113 C402.532,298.57,359.164,255.202,305.666,255.202z"></path> <path style="fill:#324A5E;" d="M111.192,389.329c0-53.498,43.368-96.866,96.866-96.866s96.866,43.368,96.866,96.866H111.192z"></path> <path style="fill:#2B3B4E;" d="M208.06,292.461c-0.014,0-0.028,0.002-0.04,0.002v96.866h96.908 C304.926,335.831,261.556,292.461,208.06,292.461z"></path> <circle style="fill:#FED8B2;" cx="305.666" cy="223.746" r="55.355"></circle> <path style="fill:#F4C69D;" d="M305.666,168.398c-0.083,0-0.164,0.005-0.247,0.007v110.692c0.083,0,0.164,0.007,0.247,0.007 c30.57,0,55.353-24.781,55.353-55.353C361.019,193.181,336.236,168.398,305.666,168.398z"></path> <circle style="fill:#FFFFFF;" cx="208.058" cy="261.017" r="55.355"></circle> <path style="fill:#F4E3C3;" d="M208.06,205.658c-0.014,0-0.028,0.002-0.04,0.002v110.702c0.014,0,0.028,0,0.04,0 c30.57,0,55.353-24.781,55.353-55.353C263.411,230.441,238.63,205.658,208.06,205.658z"></path> <polygon style="fill:#324A5E;" points="264.256,132.084 233.2,132.084 233.2,101.028 208.06,101.028 208.06,132.086 177.002,132.086 177.002,157.227 208.06,157.225 208.06,188.282 233.2,188.282 233.2,157.225 264.256,157.225 "></polygon> <polygon style="fill:#2B3B4E;" points="233.2,132.084 233.2,101.028 220.086,101.028 220.086,188.282 233.2,188.282 233.2,157.225 264.256,157.225 264.256,132.084 "></polygon> </g></svg>
                        </div>
                        <div>
                            <small class="card-title m-0">Active Accounts</small>
                            <h3 class="m-0" id="active"></h3>
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="dashboard-icon bg-warning">
                            <svg height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#25BBCC;" d="M128,178.102l87.149,119.83h32.681C247.83,231.753,194.179,178.102,128,178.102z"></path> <path style="fill:#FF9269;" d="M129.209,8.172v137.26c37.899,0,68.63-30.731,68.63-68.63 C197.839,38.892,167.108,8.172,129.209,8.172z"></path> <path style="fill:#78E3EC;" d="M128,178.102c48.128,0,87.149,53.651,87.149,119.83H8.17C8.17,231.753,61.821,178.102,128,178.102z"></path> <path style="fill:#FFB082;" d="M129.209,8.172c19.848,0,35.949,30.72,35.949,68.63c0,37.899-16.101,68.63-35.949,68.63 c-37.91,0-68.63-30.731-68.63-68.63C60.579,38.892,91.299,8.172,129.209,8.172z"></path> <path style="fill:#25BBCC;" d="M384,178.102l87.149,119.83h32.681C503.83,231.753,450.179,178.102,384,178.102z"></path> <path style="fill:#FF9269;" d="M385.209,8.172v137.26c37.899,0,68.63-30.731,68.63-68.63 C453.839,38.892,423.108,8.172,385.209,8.172z"></path> <path style="fill:#78E3EC;" d="M384,178.102c48.128,0,87.149,53.651,87.149,119.83H264.17 C264.17,231.753,317.821,178.102,384,178.102z"></path> <path style="fill:#FFB082;" d="M385.209,8.172c19.848,0,35.949,30.72,35.949,68.63c0,37.899-16.101,68.63-35.949,68.63 c-37.91,0-68.63-30.731-68.63-68.63C316.579,38.892,347.299,8.172,385.209,8.172z"></path> <path style="fill:#FF4719;" d="M256,178.102l87.149,119.83h32.681C375.83,231.753,322.179,178.102,256,178.102z"></path> <path style="fill:#FFDB8A;" d="M257.209,8.172v137.26c37.899,0,68.63-30.731,68.63-68.63 C325.839,38.892,295.108,8.172,257.209,8.172z"></path> <path style="fill:#FF754F;" d="M256,178.102c48.128,0,87.149,53.651,87.149,119.83H136.17 C136.17,231.753,189.821,178.102,256,178.102z"></path> <path style="fill:#FFEAB5;" d="M257.209,8.172c19.848,0,35.949,30.72,35.949,68.63c0,37.899-16.101,68.63-35.949,68.63 c-37.91,0-68.63-30.731-68.63-68.63C188.579,38.892,219.299,8.172,257.209,8.172z"></path> <g> <circle style="fill:#78E3EC;" cx="69.251" cy="487.489" r="16.34"></circle> <circle style="fill:#78E3EC;" cx="134.612" cy="487.489" r="16.34"></circle> <circle style="fill:#78E3EC;" cx="290.74" cy="487.489" r="16.34"></circle> </g> <path d="M257.204,153.6c42.348,0,76.8-34.452,76.8-76.8S299.552,0,257.204,0s-76.8,34.452-76.8,76.8S214.856,153.6,257.204,153.6z M257.204,16.34c33.338,0,60.46,27.122,60.46,60.46s-27.122,60.46-60.46,60.46s-60.46-27.122-60.46-60.46 S223.867,16.34,257.204,16.34z"></path> <path d="M257.203,104.758c9.331,0,17.74-5.684,20.923-14.144c1.589-4.223-0.547-8.935-4.77-10.524 c-4.221-1.588-8.934,0.546-10.523,4.769c-0.801,2.129-3.063,3.558-5.63,3.558c-2.565,0-4.829-1.43-5.63-3.559 c-1.589-4.222-6.303-6.358-10.525-4.768c-4.222,1.589-6.358,6.302-4.768,10.524C239.465,99.075,247.873,104.758,257.203,104.758z"></path> <path d="M385.203,104.758c9.331,0,17.74-5.684,20.923-14.144c1.589-4.223-0.547-8.935-4.77-10.524 c-4.222-1.588-8.935,0.546-10.523,4.769c-0.801,2.129-3.063,3.558-5.63,3.558c-2.565,0-4.829-1.43-5.63-3.559 c-1.59-4.222-6.302-6.358-10.525-4.768c-4.222,1.589-6.358,6.302-4.768,10.524C367.465,99.075,375.873,104.758,385.203,104.758z"></path> <path d="M384,169.932c-10.593,0-21.14,1.304-31.351,3.876c-4.376,1.102-7.029,5.543-5.926,9.919c1.102,4.376,5.542,7.03,9.918,5.927 c8.907-2.244,18.112-3.381,27.359-3.381c58.822,0,107.167,45.719,111.364,103.489h-86.854c-4.513,0-8.17,3.658-8.17,8.17 c0,4.512,3.657,8.17,8.17,8.17h95.319c4.513,0,8.17-3.658,8.17-8.17C512,227.352,454.58,169.932,384,169.932z"></path> <path d="M76.42,464.052v-65.855l33.785-63.563c0.627-1.181,0.955-2.497,0.955-3.835v-32.867c0-4.512-3.657-8.17-8.17-8.17H16.636 C20.833,231.992,69.177,186.272,128,186.272c9.248,0,18.453,1.137,27.359,3.381c4.377,1.1,8.816-1.551,9.918-5.927 s-1.551-8.816-5.926-9.919c-10.211-2.572-20.759-3.876-31.351-3.876c-70.58,0-128,57.42-128,128c0,4.512,3.657,8.17,8.17,8.17h86.65 v22.66l-33.785,63.564c-0.627,1.181-0.955,2.497-0.955,3.835v68.605c-8.985,3.638-15.341,12.45-15.341,22.724 c0,13.516,10.996,24.511,24.511,24.511s24.511-10.995,24.511-24.511C93.759,476.468,86.447,467.126,76.42,464.052z M69.249,495.66 c-4.506,0-8.17-3.665-8.17-8.17s3.665-8.17,8.17-8.17c4.506,0,8.17,3.665,8.17,8.17S73.754,495.66,69.249,495.66z"></path> <path d="M298.911,464.384v-68.225c0-1.338-0.329-2.654-0.955-3.835l-33.785-63.563v-22.661h111.66c4.513,0,8.17-3.658,8.17-8.17 c0-70.58-57.42-128-128-128s-128,57.42-128,128c0,4.512,3.657,8.17,8.17,8.17h25.01v22.661l-33.784,63.563 c-0.627,1.181-0.955,2.497-0.955,3.835v68.225c-9.509,3.373-16.34,12.454-16.34,23.105c0,13.516,10.996,24.511,24.511,24.511 s24.511-10.995,24.511-24.511c0-10.651-6.831-19.733-16.34-23.105v-66.187l33.784-63.563c0.627-1.181,0.955-2.497,0.955-3.835 v-24.697h70.31v24.697c0,1.338,0.329,2.654,0.955,3.835l33.785,63.563v66.187c-9.509,3.373-16.34,12.454-16.34,23.105 c0,13.516,10.996,24.511,24.511,24.511s24.511-10.995,24.511-24.511C315.251,476.839,308.42,467.757,298.911,464.384z M134.61,495.66c-4.506,0-8.17-3.665-8.17-8.17s3.665-8.17,8.17-8.17s8.17,3.665,8.17,8.17S139.116,495.66,134.61,495.66z M256,186.272c58.822,0,107.167,45.719,111.364,103.489H144.636C148.833,231.99,197.178,186.272,256,186.272z M290.741,495.66 c-4.506,0-8.17-3.665-8.17-8.17s3.665-8.17,8.17-8.17s8.17,3.665,8.17,8.17S295.245,495.66,290.741,495.66z"></path> <path d="M459.092,387.99h-135.67c-4.513,0-8.17,3.658-8.17,8.17c0,4.512,3.657,8.17,8.17,8.17h135.67c4.513,0,8.17-3.658,8.17-8.17 C467.262,391.648,463.604,387.99,459.092,387.99z"></path> <path d="M459.092,420.671h-135.67c-4.513,0-8.17,3.658-8.17,8.17c0,4.512,3.657,8.17,8.17,8.17h135.67c4.513,0,8.17-3.658,8.17-8.17 C467.262,424.329,463.604,420.671,459.092,420.671z"></path> <path d="M459.092,453.352h-67.836c-4.513,0-8.17,3.658-8.17,8.17c0,4.512,3.657,8.17,8.17,8.17h67.836c4.513,0,8.17-3.658,8.17-8.17 C467.262,457.01,463.604,453.352,459.092,453.352z"></path> <path d="M347.926,29.221c10.738-8.426,23.628-12.881,37.278-12.881c33.338,0,60.46,27.122,60.46,60.46s-27.122,60.46-60.46,60.46 c-13.649,0-26.539-4.453-37.278-12.881c-3.549-2.787-8.685-2.167-11.471,1.385c-2.785,3.549-2.166,8.685,1.385,11.471 c13.643,10.706,30.023,16.365,47.364,16.365c42.348,0,76.8-34.452,76.8-76.8S427.552,0,385.204,0 c-17.344,0-33.722,5.659-47.365,16.367c-3.55,2.785-4.169,7.921-1.385,11.471C339.24,31.388,344.378,32.007,347.926,29.221z"></path> <path d="M132.426,84.859c-0.801,2.129-3.064,3.559-5.63,3.559c-2.567,0-4.829-1.43-5.63-3.558 c-1.588-4.223-6.303-6.356-10.523-4.769c-4.223,1.588-6.36,6.301-4.77,10.524c3.183,8.46,11.592,14.144,20.923,14.144 c9.329,0,17.738-5.683,20.923-14.143c1.589-4.222-0.546-8.935-4.768-10.524C138.728,78.503,134.017,80.635,132.426,84.859z"></path> <path d="M126.797,153.6c17.342,0,33.72-5.659,47.364-16.365c3.55-2.785,4.169-7.922,1.385-11.471 c-2.788-3.551-7.923-4.169-11.471-1.385c-10.738,8.426-23.628,12.881-37.277,12.881c-33.338,0-60.46-27.122-60.46-60.46 s27.121-60.46,60.458-60.46c13.649,0,26.539,4.454,37.278,12.881c3.548,2.785,8.685,2.167,11.471-1.383 c2.786-3.55,2.166-8.685-1.385-11.471C160.519,5.659,144.139,0,126.797,0c-42.348,0-76.8,34.452-76.8,76.8 S84.448,153.6,126.797,153.6z"></path> </g></svg>
                        </div>
                        <div>
                            <small class="card-title m-0">Online Users</small>
                            <h3 class="m-0" id="online"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 
        users data
        DataTable implementation
     -->
    <div style="width: 90%;">
        <div class="users">
            <table id="users" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Code ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Identity</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $user['code_id'] ?></td>
                            <td><?= $user['fname'] ?></td>
                            <td><?= $user['lname'] ?></td>
                            <td><?= $user['zone_street'].' '.$user['barangay'].','.$user['municipality'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['social_pos'] ?></td>

                            <!-- remove user btn -->
                            <td>
                                <?php

                                if ($user['account_stats'] == 1) {
                                ?>

                                    <button type="button" class="btn btn-warning deactivate-user-btn" value="<?= $user['code_id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                        <span class="ms-2">Deactivate</span>
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <button type="button" class="btn btn-success activate-user-btn" value="<?= $user['code_id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                        <span class="ms-2">Activate</span>
                                    </button>
                                <?php
                                }
                                ?>
                                <button type="button" class="btn btn-primary delete-user-btn" value="<?= $user['code_id'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    <span class="ms-2">Archive</span>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
    $(document).ready(function() {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')

        // DataTable initialization
        $('#users').DataTable();

        $('.deactivate-user-btn').click(handleDeactivateClick)
        $('.activate-user-btn').click(handleActivateClick)
        $('.delete-user-btn').click(handleDeleteClick)

        //perma delete
        function handleDeleteClick() {
            let id = $(this).val();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#d0d0d0d",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: `${url}/admin/dashboard/archive-user/${id}`,
                        // dataType: "json",
                        success: function(res) {
                            Swal.fire(
                                "Archive",
                                "Successfully move a user to archive",
                                "success"
                            );
                            location.reload()
                        },
                        error: function(err) {
                            console.error(err);
                        },
                    });
                }
            });
        }

        //Deactivate 
        function handleDeactivateClick() {
            let id = $(this).val();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#d0d0d0d",
                confirmButtonText: "Proceed",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: `${url}/admin/dashboard/deactivate-user/${id}`,
                        // dataType: "json",
                        success: function(res) {
                            Swal.fire(
                                "Deactivate",
                                "You have successfully deactivated a user",
                                "success"
                            );
                            location.reload()
                        },
                        error: function(err) {
                            console.error(err);
                        },
                    });
                }
            });
        }

        //Activate User
        function handleActivateClick() {
            let id = $(this).val();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#d0d0d0d",
                confirmButtonText: "Proceed",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: `${url}/admin/dashboard/reactivate-user/${id}`,
                        // dataType: "json",
                        success: function(res) {
                            Swal.fire(
                                "Activate",
                                "You have successfully Activated a user",
                                "success"
                            );
                            location.reload()
                        },
                        error: function(err) {
                            console.error(err);
                        },
                    });
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>