document.addEventListener("DOMContentLoaded", function(e) {
  // console.log('we are confirmed loaded');


// Header things

  const
    header = document.querySelector('.site-header'),
    headerSearch = document.querySelector('.site-header .menu-search'),
    mobileToggle = document.querySelector('#main-navigation-toggle');

  function toggleClass(q, r) {
      if(header.classList.contains(q)) {
        header.classList.remove(q);
      } else {
        header.classList.add(q);
      }
  }
  function checkClass(q) {
    if(header.classList.contains(q)) {
      return true;
    } else { return false };
  }

  if(headerSearch) {
    headerSearch.addEventListener('click', function() {
      // toggleClass('search-open', headerSearch);
      if(checkClass('search-open')) {
        header.classList.remove('search-open');
        headerSearch.setAttribute('aria-expanded', false);
      } else {
        header.classList.add('search-open');
        headerSearch.setAttribute('aria-expanded', true);
      }
    })
  }

  mobileToggle.addEventListener('click', function() {
    // toggleClass('mobile-menu-open', mobileToggle);
    if(checkClass('mobile-menu-open')) {
      header.classList.remove('mobile-menu-open');
      mobileToggle.setAttribute('aria-expanded', false);
    } else {
      header.classList.add('mobile-menu-open');
      mobileToggle.setAttribute('aria-expanded', true);
    }
  });

  document.querySelector('.search-clear-all').addEventListener('click', function() {
    document.querySelectorAll('.dropdown-panel--input input[type="checkbox"]:checked').forEach((chbx, ndx) => {
      chbx.checked = false;
    });
  } );


// Search dropdown things

  const ddown = document.querySelector('.input-row .dropdown');
  ddown.addEventListener('click', function() {
    if(ddown.classList.contains('open')) {
      ddown.classList.remove('open');
    } else {
      ddown.classList.add('open');
    }
  });

  ddown.addEventListener('blur', function() {
    if(ddown.classList.contains('open')) {
      ddown.classList.remove('open');
    }
  });

  document.querySelector('.input-row .dropdown-panel').addEventListener('click', function(e) {
    e.stopPropagation();
  });

  document.querySelector('.input-row .dropdown-close').addEventListener('click', function(e) {
    ddown.classList.remove('open');
  });


// Search support things

  const url = window.location.href;

  function flipTaxTag(val) {
    document.querySelectorAll('.tax-switch').forEach((tag, ndx) => {
      tag.disabled = val;
    });
  }

  if(!url.includes('term')) {
    flipTaxTag(true);
  }

  document.querySelectorAll('.dropdown-panel--input input[type="checkbox"]').forEach((cBox, ndx) => {
    cBox.addEventListener('change', function() {
      if(this.checked) {
        flipTaxTag(false);
      } else {
        let checked = document.querySelectorAll('.dropdown-panel--input input[type="checkbox"]:checked');
        if(checked.length == 0) flipTaxTag(true);
      }
    })
  });





});
