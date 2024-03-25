libraire.js

const apiUrl = 'http://www.googleapis.com/books/v1/volumes?q=subject:geography&langRestrict=fr'

const librairieEnLigne = document.getElementById('livre');
class books
{contactForm.addEventListener('submit', function (event) {
    event.preventDefault();

  const formData = new FormData(librairieEnLigne);

  const requestOptions = {
    method: 'POST',
    body: formData,
  };

  fetch('http://www.googleapis.com/books/v1/volumes?q=subject:geography&langRestrict=fr', requestOptions)
    .then(response => {
        
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(data => {
      responseMessage.textContent = data;
    })
    .catch(error => {
      console.error('Error:', error);
    });
})};
