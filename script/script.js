const splide = new Splide(".splide", {
    type: "loop"
  }).mount();
  
  const scrollUpButton = document.getElementById("scrollUpButton");
  let dropDown = false;
  
  scrollUpButton.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
  
  function toggleDropDown() {
    const dropdownMenu = document.getElementById('dropdownMenu');
    const dropDownIcon = document.getElementById('dropDownIcon');
    dropDown = !dropDown;
    if (dropDown) {
      dropdownMenu.classList.remove('hidden');
      dropdownMenu.classList.add('block');
      dropDownIcon.classList.remove('fa-bars');
      dropDownIcon.classList.add('fa-x');
    } else {
      dropdownMenu.classList.remove('block');
      dropdownMenu.classList.add('hidden');
      dropDownIcon.classList.remove('fa-x');
      dropDownIcon.classList.add('fa-bars');
    }
  }

  const dropDownIcon = document.getElementById('dropDownIcon');
  dropDownIcon.addEventListener('click', (e)=>{
    e.stopPropagation();
    toggleDropDown();
  })
  
  // Close dropdown when any link inside it is clicked
  const dropdownLinks = document.querySelectorAll('.dropdown a');
  dropdownLinks.forEach(link => {
    link.addEventListener('click', () => {
      toggleDropDown();
    });
  });
  