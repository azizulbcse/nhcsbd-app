<div class="branding d-flex align-items-center">
  <div class="container position-relative d-flex align-items-center justify-content-between">
    
    <!-- লোগো সেকশন -->
    <a href="index.php" class="logo d-flex align-items-center" style="text-decoration: none; display: flex; align-items: center;">
      <img src="assets/img/logo.png" alt="NHCS Logo" style="max-height: 65px; margin-right: 15px; filter: drop-shadow(0px 4px 8px rgba(0, 123, 255, 0.2)); transition: 0.3s;">
      <div style="border-left: 2px solid #007bff33; padding-left: 15px;">
        <h2 class="sitename" style="font-size: 18px; font-weight: 800; margin: 0; line-height: 1.2; background: linear-gradient(90deg, #0056b3, #00d2ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: 0.3px; text-transform: uppercase; font-family: 'Poppins', sans-serif;">
          Nurses Health Care Society Bangladesh
        </h2>
      </div>
    </a>

    <!-- নেভিগেশন মেনু -->
    <nav id="navmenu" class="navmenu">
      <ul>
        <!-- Home -->
        <li style="list-style: none;">
          <a href="index.php" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: <?= ($current_page == 'index.php') ? '#0077b6' : '#444'; ?>; background: <?= ($current_page == 'index.php') ? 'rgba(0, 119, 182, 0.1)' : 'transparent'; ?>; padding: 5px 10px; border-radius: 5px;">
            <i class="bi bi-house-heart-fill" style="font-size: 18px; color: #0077b6; filter: drop-shadow(0 2px 4px rgba(0, 119, 182, 0.2));"></i> Home
          </a>
        </li>

        <!-- Constitution -->
        <!--<li>
          <a href="constitution.php" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: <?= ($current_page == 'constitution.php') ? '#6f42c1' : '#444'; ?>; background: <?= ($current_page == 'constitution.php') ? 'rgba(111, 66, 193, 0.1)' : 'transparent'; ?>; padding: 5px 10px; border-radius: 5px;">
            <i class="bi bi-journal-bookmark-fill" style="font-size: 18px; color: #6f42c1; filter: drop-shadow(0 2px 4px rgba(111, 66, 193, 0.2));"></i> Constitution
          </a>
        </li>-->

        <!-- Admin List -->
        <li>
          <a href="admin-list.php" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: <?= ($current_page == 'admin-list.php') ? '#fd7e14' : '#444'; ?>; background: <?= ($current_page == 'admin-list.php') ? 'rgba(253, 126, 20, 0.1)' : 'transparent'; ?>; padding: 5px 10px; border-radius: 5px;">
            <i class="bi bi-person-workspace" style="font-size: 18px; color: #fd7e14; filter: drop-shadow(0 2px 4px rgba(253, 126, 20, 0.2));"></i> Administrator List
          </a>
        </li>

        <!-- Member List -->
        <li>
          <a href="member-list.php" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: <?= ($current_page == 'member-list.php') ? '#e91e63' : '#444'; ?>; background: <?= ($current_page == 'member-list.php') ? 'rgba(233, 30, 99, 0.1)' : 'transparent'; ?>; padding: 5px 10px; border-radius: 5px;">
            <i class="bi bi-heart-pulse-fill" style="font-size: 18px; color: #e91e63; filter: drop-shadow(0 2px 4px rgba(233, 30, 99, 0.2));"></i> Member List
          </a>
        </li>

        <!-- Notice -->
        <li>
          <a href="notice.php" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: <?= ($current_page == 'notice.php') ? '#00d2ff' : '#444'; ?>; background: <?= ($current_page == 'notice.php') ? 'rgba(0, 210, 255, 0.1)' : 'transparent'; ?>; padding: 5px 10px; border-radius: 5px;">
            <i class="bi bi-megaphone-fill" style="font-size: 18px; color: #00d2ff; filter: drop-shadow(0 2px 4px rgba(0, 210, 255, 0.2));"></i> Notice
          </a>
        </li>

        <!-- Gallery Dropdown -->
        <li class="dropdown">
          <a href="#" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: <?= ($isGalleryActive) ? '#ffc107' : '#444'; ?>; background: <?= ($isGalleryActive) ? 'rgba(255, 193, 7, 0.1)' : 'transparent'; ?>; padding: 5px 10px; border-radius: 5px;">
            <i class="bi bi-collection-play-fill" style="font-size: 18px; color: #ffc107;"></i>
            <span>Gallery</span> <i class="bi bi-chevron-down toggle-dropdown" style="font-size: 12px; margin-left: auto;"></i>
          </a>
          <ul>
            <li><a href="photo-gallery.php" style="<?= ($current_page == 'photo-gallery.php') ? 'color: #ffc107;' : ''; ?>">Photo Gallery</a></li>
            <li><a href="video-gallery.php" style="<?= ($current_page == 'video-gallery.php') ? 'color: #ffc107;' : ''; ?>">Video Gallery</a></li>                
          </ul>
        </li>

        <!-- Deposit Details -->
        <li>
          <a href="contact-payment.php" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: <?= ($current_page == 'contact-payment.php') ? '#20c997' : '#444'; ?>; background: <?= ($current_page == 'contact-payment.php') ? 'rgba(32, 201, 151, 0.1)' : 'transparent'; ?>; padding: 5px 10px; border-radius: 5px;">
            <i class="bi bi-bank" style="font-size: 18px; color: #20c997; filter: drop-shadow(0 2px 4px rgba(32, 201, 151, 0.2));"></i> Deposit Details
          </a>
        </li>

        <!-- Contact -->
        <li>
          <a href="contact.php" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: <?= ($current_page == 'contact.php') ? '#20c997' : '#444'; ?>; background: <?= ($current_page == 'contact.php') ? 'rgba(32, 201, 151, 0.1)' : 'transparent'; ?>; padding: 5px 10px; border-radius: 5px;">
            <i class="bi bi-telephone-outbound-fill" style="font-size: 18px; color: #20c997; filter: drop-shadow(0 2px 4px rgba(32, 201, 151, 0.2));"></i> Contact
          </a>
        </li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>      
</div>
