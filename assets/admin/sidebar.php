<style>
    a {
        text-decoration: none;
    }
    .sidebar-nav {
        font-size: 14px;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
        flex-grow: 1;
    }
    .sidebar {
        min-width: 260px;
        max-width: 260px;
        direction: ltr;
        font-family: sans-serif;
    }
    .sidebar,
    .sidebar-content {
        transition: margin-left 0.35s ease-in-out, left 0.35s ease-in-out, margin-right 0.35s ease-in-out, right 0.35s ease-in-out;
        background: #222e3c;
    }
    .sidebar-content {
        display: flex;
        height: 100vh;
        flex-direction: column;
    }
    .sidebar-nav {
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
        flex-grow: 1;
    }
    .sidebar-link,
    a.sidebar-link {
        display: block;
        padding: 0.625rem 1.625rem;
        font-weight: 400;
        transition: background 0.1s ease-in-out;
        position: relative;
        text-decoration: none;
        cursor: pointer;
        color: rgba(233, 236, 239, 0.5);
        background: #222e3c;
        border-left: 3px solid transparent;
    }
    .sidebar-link i,
    .sidebar-link svg,
    a.sidebar-link i,
    a.sidebar-link svg {
        margin-right: 0.75rem;
        color: rgba(233, 236, 239, 0.5);
    }
    .sidebar-link:focus {
        outline: 0;
    }
    .sidebar-link:hover {
        background: #222e3c;
        border-left-color: transparent;
    }
    .sidebar-link:hover,
    .sidebar-link:hover i,
    .sidebar-link:hover svg {
        color: rgba(233, 236, 239, 0.75);
    }
    .sidebar-item.active .sidebar-link:hover,
    .sidebar-item.active > .sidebar-link {
        color: #e9ecef;
        background: linear-gradient(90deg, rgba(59, 125, 221, 0.1), rgba(59, 125, 221, 0.0875) 50%, transparent);
        border-left-color: #3b7ddd;
    }
    .sidebar-item.active .sidebar-link:hover i,
    .sidebar-item.active .sidebar-link:hover svg,
    .sidebar-item.active > .sidebar-link i,
    .sidebar-item.active > .sidebar-link svg {
        color: #e9ecef;
    }
    .sidebar-dropdown .sidebar-link {
        padding: 0.625rem 1.5rem 0.625rem 2.25rem;
        font-weight: 400;
        font-size: 90%;
        border-left: 0;
        color: #adb5bd;
        background: transparent;
    }
    .sidebar-dropdown .sidebar-item .sidebar-link:hover {
        font-weight: 400;
        border-left: 0;
        color: #e9ecef;
        background: transparent;
    }
    .sidebar-dropdown .sidebar-item .sidebar-link:hover:hover:before {
        transform: translateX(4px);
    }
    .sidebar-dropdown .sidebar-item.active .sidebar-link {
        font-weight: 400;
        border-left: 0;
        color: #518be1;
        background: transparent;
    }
    .sidebar [data-toggle="collapse"] {
        position: relative;
    }
    .sidebar [data-toggle="collapse"]:after {
        content: " ";
        border: solid;
        border-width: 0 0.075rem 0.075rem 0;
        display: inline-block;
        padding: 2px;
        transform: rotate(45deg);
        position: absolute;
        top: 1.2rem;
        right: 1.5rem;
        transition: all 0.2s ease-out;
    }
    .sidebar [aria-expanded="true"]:after,
    .sidebar [data-toggle="collapse"]:not(.collapsed):after {
        transform: rotate(-135deg);
        top: 1.4rem;
    }
    .sidebar-brand {
        font-weight: 600;
        font-size: 1.15rem;
        padding: 1.15rem 1.5rem;
        display: block;
        color: #f8f9fa;
    }
    .sidebar-brand:hover {
        text-decoration: none;
        color: #f8f9fa;
    }
    .sidebar-brand:focus {
        outline: 0;
    }
    .sidebar-toggle {
        cursor: pointer;
        width: 26px;
        height: 26px;
    }
    .sidebar.collapsed {
        margin-left: -260px;
    }
    @media (min-width: 1px) and (max-width: 991.98px) {
        .sidebar {
            margin-left: -260px;
        }
        .sidebar.collapsed {
            margin-left: 0;
        }
    }
    .sidebar-toggle {
        margin-right: 1rem;
    }
    .sidebar-header {
        background: transparent;
        padding: 1.5rem 1.5rem 0.375rem;
        font-size: 0.75rem;
        color: #ced4da;
    }
    .sidebar-badge {
        position: absolute;
        right: 15px;
        top: 14px;
        z-index: 1;
    }
    .sidebar-cta-content {
        padding: 1.5rem;
        margin: 1.75rem;
        border-radius: 0.3rem;
        background: #2b3947;
        color: #e9ecef;
    }
    .min-vw-50 {
        min-width: 50vw !important;
    }
    .min-vh-50 {
        min-height: 50vh !important;
    }
</style>


<style>
    .list-inline, .list-unstyled {
        padding-left: 0;
        list-style: none;
    }
    .sidebar-dropdown {
        display: none;
    }
    
    .sidebar-dropdown.show {
        display: block;
    }
</style>


<style>
    .sidebar-dropdown {
        height: 0;
        overflow: hidden;
        transition: height 0.3s ease-in-out;
    }

    .sidebar-dropdown.show {
        height: 100%; /* Adjust this value as needed */
    }
</style>


<style>
    .sidebar-dropdown {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-in-out;
    }

    .sidebar-dropdown.show {
        max-height: 1000px; /* Adjust this value as needed */
        animation: slideDown 0.3s ease-in-out forwards;
    }

    .sidebar-dropdown.hide {
        animation: slideUp 0.3s ease-in-out forwards;
    }

    @keyframes slideDown {
        0% {
            max-height: 0;
            opacity: 0;
        }
        100% {
            max-height: 1000px; /* Adjust this value as needed */
            opacity: 1;
        }
    }

    @keyframes slideUp {
        0% {
            max-height: 1000px; /* Adjust this value as needed */
            opacity: 1;
        }
        100% {
            max-height: 0;
            opacity: 0;
        }
    }
</style>





<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">
        <a class="sidebar-brand" href="./index">
            <span class="align-middle">Admin Area</span>
        </a>

        <ul class="sidebar-nav">
            <!-- <li class="sidebar-header">
                Pages
            </li> -->

            <li class="sidebar-item">
                <a class="sidebar-link" href="index">
                    <!-- <i class="align-middle" data-feather="sliders"></i> -->
                     <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="site-settings">
                     <span class="align-middle">Site Settings</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="contact-details">
                     <span class="align-middle">Contact Details</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a data-target="#ui2" data-toggle="collapse" onclick="toggleDropdown('ui2')" class="sidebar-link collapsed">
                    <!-- <i class="align-middle" data-feather="briefcase"></i>  -->
                    <span class="align-middle">FAQs</span>
                </a>
                <ul id="ui2" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a style='display: flex; flex-flow: row nowrap; align-items: center; color: #fff;' class="sidebar-link" href="faqs"><i class='ion-ios-arrow-thin-right'></i>FAQs</a></li>
                    <li class="sidebar-item"><a style='display: flex; flex-flow: row nowrap; align-items: center; color: #fff;' class="sidebar-link" href="create-faq"><i class='ion-ios-arrow-thin-right'></i>New FAQ</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="messages">
                     <span class="align-middle">Messages</span>
                </a>
            </li>

        </ul>

    </div>
</nav>





<script defer >
    function toggleDropdown(targetId) {
        const target = document.getElementById(targetId);
        const isOpen = target.classList.contains('show');
        
        if (isOpen) {
            target.classList.remove('show');
            target.classList.add('hide');
            setTimeout(() => {
                target.classList.remove('hide');
            }, 1000); // Adjust this delay to match your transition duration
        } else {
            const dropdowns = document.querySelectorAll('.sidebar-dropdown.show');
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
                dropdown.classList.add('hide');
                setTimeout(() => {
                    dropdown.classList.remove('hide');
                }, 1000); // Adjust this delay to match your transition duration
            });

            target.classList.remove('hide');
            target.classList.add('show');
        }
    }
</script>
