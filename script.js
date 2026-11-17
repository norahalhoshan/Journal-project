
// Shared JavaScript for the journal website.
// This file can be loaded on every page; missing elements are safely ignored.

document.addEventListener('DOMContentLoaded', function () {
  // Set today's date in a date input when it exists.
  const dateInput = document.getElementById('calendar');
  if (dateInput && !dateInput.value) {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    dateInput.value = `${yyyy}-${mm}-${dd}`;
  }

  // Clock: update the digits every second and trigger the existing CSS animation.
  function updateElementIfChanged(elementId, newValue) {
    const element = document.getElementById(elementId);
    if (!element || element.textContent === newValue) return;
    element.classList.remove('animate-flip');
    element.textContent = newValue;
    element.setAttribute('date-time', newValue);
    void element.offsetWidth; // Restart the CSS animation.
    element.classList.add('animate-flip');
  }

  function updateClock() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    updateElementIfChanged('hours', hours);
    updateElementIfChanged('minutes', minutes);
  }
  if (document.getElementById('hours') || document.getElementById('minutes')) {
    updateClock();
    setInterval(updateClock, 1000);
  }

  // Calendar: draw the selected month and highlight today's date.
  let calendarDate = new Date();
  const monthYear = document.querySelector('.monthYear');
  const calendarGrid = document.querySelector('.calendar-grid');

  function renderCalendar() {
    if (!monthYear || !calendarGrid) return;
    monthYear.textContent = calendarDate.toLocaleString('en-US', {
      month: 'long', year: 'numeric'
    });
    monthYear.style.whiteSpace = 'nowrap';
    monthYear.style.fontSize = '16px';

    calendarGrid.querySelectorAll('.generated-day').forEach(day => day.remove());
    const year = calendarDate.getFullYear();
    const month = calendarDate.getMonth();
    const firstDay = new Date(year, month, 1).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();
    const today = new Date();

    for (let i = 0; i < firstDay; i++) {
      const empty = document.createElement('span');
      empty.className = 'generated-day';
      calendarGrid.appendChild(empty);
    }
    for (let day = 1; day <= totalDays; day++) {
      const date = document.createElement('span');
      date.className = 'generated-day';
      date.textContent = day;
      if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
        date.style.backgroundColor = '#f5b6c8';
        date.style.borderRadius = '50%';
        date.style.width = '30px';
        date.style.height = '30px';
        date.style.display = 'flex';
        date.style.alignItems = 'center';
        date.style.justifyContent = 'center';
        date.style.margin = 'auto';
        date.style.fontWeight = 'bold';
      }
      calendarGrid.appendChild(date);
    }
  }
  renderCalendar();

  // Login: validate empty fields before sending them to PHP.
  const loginWarning = document.getElementById('loginWarning');
  const loginForm = loginWarning?.closest('form') || document.querySelector('form#loginForm');
  if (loginForm) {
    const username = loginForm.querySelector('[name="username"]');
    const password = loginForm.querySelector('[name="password"]');
    if (username && password) {
      [username, password].forEach(field => {
        field.addEventListener('input', () => {
          markField(field, field.value.trim() !== '');
          if (loginWarning) loginWarning.textContent = '';
        });
      });
      loginForm.addEventListener('submit', event => {
        const validUsername = markField(username, username.value.trim() !== '');
        const validPassword = markField(password, password.value.trim() !== '');
        if (!validUsername || !validPassword) {
          event.preventDefault();
          showMessage(loginWarning, 'Please fill in all fields.');
        }
      });
    }
  }


  // Terms and Conditions checkbox
const terms = document.querySelector('input[name="agreeTerms"]');
const registerBtn = document.querySelector('#regbtn');

if (terms && registerBtn) {
    registerBtn.disabled = !terms.checked;

    terms.addEventListener('change', function() {
    registerBtn.disabled = !terms.checked;
    });
}



  // Register: check format, email, password length and matching confirmation.
  const registerMarker = document.getElementById('usernameRegistered');
  const registerForm = registerMarker?.closest('form') || document.querySelector('form#registerForm');
  if (registerForm) {
    const username = registerForm.querySelector('[name="username"]');
    const email = registerForm.querySelector('[name="email"]');
    const password = registerForm.querySelector('[name="password"]');
    const confirmPassword = registerForm.querySelector('[name="confirm_password"], [name="confirmPassword"], [name="password_confirmation"], [name="confirm"]');
    const usernameMessage = document.getElementById('usernameRegistered');
    const emailMessage = document.getElementById('emailRegistered');
    const passwordMessage = document.getElementById('passwordLen');
    const formMessage = document.getElementById('emptyField') || document.getElementById('error');

    // Adjust these rules if the PHP registration rules are different.
    const usernameIsValid = () => username && /^[A-Za-z0-9_]{3,20}$/.test(username.value.trim());
    const emailIsValid = () => email && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim());
    const passwordIsValid = () => password && password.value.length >= 8;
    const confirmationIsValid = () => !confirmPassword || (password && confirmPassword.value === password.value && confirmPassword.value !== '');

    function validateRegister(showErrors) {
      const checks = [
        [username, usernameIsValid(), usernameMessage, 'Username must be 3–20 letters, numbers or underscores.'],
        [email, emailIsValid(), emailMessage, 'Please enter a valid email address.'],
        [password, passwordIsValid(), passwordMessage, 'Password must be at least 8 characters.'],
        [confirmPassword, confirmationIsValid(), null, 'Passwords do not match.']
      ];
      let allValid = true;
      for (const [field, valid, message, error] of checks) {
        if (!field) continue;
        markField(field, valid);
        if (showErrors && message) showMessage(message, valid ? '' : error);
        if (!valid) allValid = false;
      }
      if (showErrors && formMessage) showMessage(formMessage, allValid ? '' : 'Please correct the highlighted fields.');
      return allValid;
    }
    [username, email, password, confirmPassword].filter(Boolean).forEach(field => {
      field.addEventListener('input', () => validateRegister(false));
    });
    registerForm.addEventListener('submit', event => {
      if (!validateRegister(true)) event.preventDefault();
    });
  }

  
  
    


  // Add/Edit: check that title and content are not empty.
  // Forms must use name="title" and name="content" (or name="body").
  document.querySelectorAll('form').forEach(form => {
    if (form === loginForm || form === registerForm) return;
    const title = form.querySelector('[name="title"]');
    const content = form.querySelector('[name="content"], [name="body"]');
    if (!title || !content) return;
    [title, content].forEach(field => {
      field.addEventListener('input', () => markField(field, field.value.trim() !== ''));
    });
    form.addEventListener('submit', event => {
      const titleValid = markField(title, title.value.trim() !== '');
      const contentValid = markField(content, content.value.trim() !== '');
      if (!titleValid || !contentValid) {
        event.preventDefault();
        alert('Please fill in the title and content.');
      }
    });
  });

  // Delete: attach confirmation only to explicitly marked delete controls.
  document.querySelectorAll('[data-confirm-delete]').forEach(control => {
    control.addEventListener('click', event => {
      if (!confirm('Are you sure you want to delete this entry?')) {
        event.preventDefault();
        event.stopPropagation();
      }
    });
  });
});

function markField(field, valid) {
  if (!field) return false;
  field.style.borderColor = valid ? 'green' : 'red';
  return valid;
}

function showMessage(element, message) {
  if (!element) return;
  element.textContent = message;
  element.style.color = 'red';
}

// Called by the existing Previous / Next calendar buttons.
function changeMonth(direction) {
  if (!window.calendarNavigationDate) window.calendarNavigationDate = new Date();
  // The page-level calendar uses its own date; dispatch the direction below.
  document.dispatchEvent(new CustomEvent('calendar-change', { detail: Number(direction) }));
}

// Calendar navigation handler kept separate to support inline onclick buttons.
document.addEventListener('DOMContentLoaded', () => {
  // This listener uses the calendar's displayed month as the starting point.
  let navigationDate = new Date();
  document.addEventListener('calendar-change', event => {
    navigationDate.setDate(1);
    navigationDate.setMonth(navigationDate.getMonth() + event.detail);
    const heading = document.querySelector('.monthYear');
    const grid = document.querySelector('.calendar-grid');
    if (!heading || !grid) return;
    heading.textContent = navigationDate.toLocaleString('en-US', { month: 'long', year: 'numeric' });
    grid.querySelectorAll('.generated-day').forEach(day => day.remove());
    const firstDay = new Date(navigationDate.getFullYear(), navigationDate.getMonth(), 1).getDay();
    const days = new Date(navigationDate.getFullYear(), navigationDate.getMonth() + 1, 0).getDate();
    for (let i = 0; i < firstDay; i++) {
      const blank = document.createElement('span');
      blank.className = 'generated-day';
      grid.appendChild(blank);
    }
    const today = new Date();
    for (let day = 1; day <= days; day++) {
      const cell = document.createElement('span');
      cell.className = 'generated-day';
      cell.textContent = day;
      if (day === today.getDate() && navigationDate.getMonth() === today.getMonth() && navigationDate.getFullYear() === today.getFullYear()) {
        Object.assign(cell.style, { backgroundColor: '#f5b6c8', borderRadius: '50%', width: '30px', height: '30px', display: 'flex', alignItems: 'center', justifyContent: 'center', margin: 'auto', fontWeight: 'bold' });
      }
      grid.appendChild(cell);
    }
  });
});