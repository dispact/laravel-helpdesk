function data() {
    function getThemeFromLocalStorage() {
      // if user already changed the theme, use it
      if (window.localStorage.getItem('dark')) {
        return JSON.parse(window.localStorage.getItem('dark'))
      }
  
      // else return their preferences
      return (
        !!window.matchMedia &&
        window.matchMedia('(prefers-color-scheme: dark)').matches
      )
    }
  
    function setThemeToLocalStorage(value) {
      window.localStorage.setItem('dark', value)
    }
  
    return {
      dark: getThemeFromLocalStorage(),
      toggleTheme() {
        this.dark = !this.dark
        setThemeToLocalStorage(this.dark)
      },
      isSideMenuOpen: false,
      toggleSideMenu() {
        this.isSideMenuOpen = !this.isSideMenuOpen
      },
      closeSideMenu() {
        this.isSideMenuOpen = false
      },
      isNotificationsMenuOpen: false,
      toggleNotificationsMenu() {
        this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
      },
      closeNotificationsMenu() {
        this.isNotificationsMenuOpen = false
      },
      isProfileMenuOpen: false,
      toggleProfileMenu() {
        this.isProfileMenuOpen = !this.isProfileMenuOpen
      },
      closeProfileMenu() {
        this.isProfileMenuOpen = false
      },
      isManagementMenuOpen: false,
      toggleManagementMenu() {
        this.isManagementMenuOpen = !this.isManagementMenuOpen
      },
      isCreateUserMenuOpen: false,
      toggleCreateUserMenu() {
        this.isCreateUserMenuOpen = !this.isCreateUserMenuOpen
      },
      isEditUserMenuOpen: false,
      toggleEditUserMenu() {
        this.isEditUserMenuOpen = !this.isEditUserMenuOpen
      },
      isEditStaffMenuOpen: false,
      toggleEditStaffMenu() {
        this.isEditStaffMenuOpen = !this.isEditStaffMenuOpen
      },
      isCreateStatusMenuOpen: false,
      toggleCreateStatusMenu() {
        this.isCreateStatusMenuOpen = !this.isCreateStatusMenuOpen
      },
      isEditStatusMenuOpen: false,
      toggleEditStatusMenu() {
        this.isEditStatusMenuOpen = !this.isEditStatusMenuOpen
      },
      isCreateDeviceMenuOpen: false,
      toggleCreateDeviceMenu() {
        this.isCreateDeviceMenuOpen = !this.isCreateDeviceMenuOpen
      },
      isEditDeviceMenuOpen: false,
      toggleEditDeviceMenu() {
        this.isEditDeviceMenuOpen = !this.isEditDeviceMenuOpen
      },
      // Modal
      isModalOpen: false,
      trapCleanup: null,
      openModal() {
        this.isModalOpen = true
        this.trapCleanup = focusTrap(document.querySelector('#modal'))
      },
      closeModal() {
        this.isModalOpen = false
        this.trapCleanup()
      },
    }
  }