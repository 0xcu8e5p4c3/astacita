
const wrapper = document.getElementById('flipWrapper');
const panels = document.querySelectorAll('.form-panel');

function flipTo(target) {
  wrapper.classList.remove('rotate-y-left', 'rotate-y-right');
  panels.forEach(p => p.classList.remove('active'));

  if (target === 'signup') {
    wrapper.classList.add('rotate-y-right');
  } else if (target === 'forgot') {
    wrapper.classList.add('rotate-y-left');
  }

  setTimeout(() => {
    if (target === 'signup') document.querySelector('.panel-signup').classList.add('active');
    else if (target === 'forgot') document.querySelector('.panel-forgot').classList.add('active');
    else document.querySelector('.panel-user').classList.add('active');
  }, 400);
}

document.querySelector('.panel-user').classList.add('active');
