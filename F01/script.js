window.addEventListener('scroll', function() {
    let header = document.getElementById('header');
    let section2 = document.getElementById('about');
  
    if (header && section2) {
        if (window.scrollY > section2.offsetTop - header.offsetHeight) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }
  });

  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('staticBackdrop');
    if (modal) {
        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
    }
});

const modal = document.getElementById('modal');
modal.addEventListener('show.bs.modal', event => {
const button = event.relatedTarget;
const action = button.getAttribute('data-action');
const type = button.getAttribute('data-type');
const id = button.getAttribute('data-id');
const content = button.getAttribute('data-content');
const image = button.getAttribute('data-image');

document.getElementById('modalAction').value = action;
document.getElementById('modalType').value = type;
document.getElementById('modalId').value = id || '';
document.getElementById('modalContent').value = content || '';
document.getElementById('modalImage').value = '';
document.getElementById('modalLabel').textContent = action === 'add' ? `Add ${type}` : `Edit ${type}`;
});