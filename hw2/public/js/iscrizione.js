
document.addEventListener("DOMContentLoaded", function () {

  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  document.querySelectorAll('select[name="plan"]').forEach(select => {
    select.addEventListener('change', function () {
      const courseId = this.dataset.courseId;
      const selectedPlan = this.value;
      const priceElement = document.getElementById('price-'+courseId);
      const basePrice = parseFloat(priceElement.dataset.mensile);

      let updatedPrice;
      if (selectedPlan === 'mensile') {
        updatedPrice = basePrice;
      } else if (selectedPlan === 'semestrale') {
        updatedPrice = basePrice * 6;
      } else if (selectedPlan === 'annuale') {
        updatedPrice = basePrice * 12;
      }

      priceElement.textContent = updatedPrice.toFixed(2)+'€';      
    
    });
  });

  document.querySelectorAll('.course-form').forEach(form => {
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      const courseId = this.dataset.courseId;
      const select = this.querySelector('select[name="plan"]').value;
      const formData = new FormData(this);
      formData.append('course_id', courseId);
      formData.append('plan', select);

      fetch(BaseURL+'join_course', {
        headers: {
          'X-CSRF-TOKEN': csrfToken
        },
        method: 'POST',
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'full') {
            alert('Il corso ha raggiunto il numero massimo di iscritti.');
          } else if (data.status === 'already_joined') {
            alert('Sei già iscritto a questo corso.');
          } else if (data.status === 'joined') {
            alert('Iscrizione completata con successo!');
            const submitButton = this.querySelector('.price__btn');
            submitButton.disabled = true;
            submitButton.textContent = 'Iscritto';
          }
        })
        .catch(error => console.error('Errore durante l\'iscrizione:', error));
    });
  });
})

