const search = document.querySelector('.search');
const go = document.querySelector('.go');
const books = document.querySelector('.books');
const genre = document.querySelector('.genre');
const favoris = document.querySelector('.favoris');



go.addEventListener('click', async () => {
    const booktitle = search.value;
    try {
        const response = await axios.get(`https://www.googleapis.com/books/v1/volumes?q=${booktitle}`);
        const book = response.data.items;
        books.innerHTML = '';

        book.forEach(book => {
            const { title, authors, imageLinks } = book.volumeInfo;
            let truncatedTitle = title;
            if (title.length > 20) {
                truncatedTitle = title.substring(0, 45) + '...';
            }
            const imageUrl = imageLinks ? imageLinks.thumbnail : 'https://img.freepik.com/vecteurs-libre/pile-design-plat-dessine-main-illustration-livres_23-2149341898.jpg?size=338&ext=jpg&ga=GA1.1.1546980028.1711324800&semt=sph%27';
            const html = `
                <img class="poster" src="${imageUrl}" alt="poster">
                <p >Auteur : ${authors}</p> 
                <p class="title">${truncatedTitle}</p>
            `;

            const bookElement = document.createElement('div');
            bookElement.innerHTML = html;
            books.appendChild(bookElement);

            const favbtn = document.createElement('button');
            favbtn.classList.add('addfavorite');
            favbtn.textContent = 'Ajoutez aux favoris';
            bookElement.appendChild(favbtn);

            favbtn.addEventListener('click', () => {
                const id = book.id;
                window.location.href = `favoris.view.php?id=${id}&title=${encodeURIComponent(title)}&authors=${encodeURIComponent(authors)}&imageLinks=${encodeURIComponent(imageUrl)}`;
                
            });
        });
    } catch (error) {
        console.error(error);
    }
});



// go.addEventListener('click', async () => {
//     const bookgenre = genre.value;
//     try {
//         const response = await axios.get(`https://www.googleapis.com/books/v1/volumes?q=subject:${bookgenre}&langRestrict=fr`);
//         const book = response.data.items;
//         books.innerHTML = '';

//         book.forEach(book => {
//             const { title, authors, imageLinks } = book.volumeInfo;
//             let truncatedTitle = title;
//             if (title.length > 20) {
//                 truncatedTitle = title.substring(0, 45) + '...';
//             }
//             const html = `
//                 <img src="${imageLinks.thumbnail}" alt="poster">
//                 <p>Auteur : ${authors}</p> 
//                 <p class="title">${truncatedTitle}</p>
//                 <form action="" method="post">
//                 <button class="addfavorite" type="button" name=addfavorite>Ajoutez aux favoris</button>
//                 </form>
//             `;

//             const bookElement = document.createElement('div');
//             bookElement.innerHTML = html;
//             books.appendChild(bookElement);

//             const favbtn = document.querySelector('.addfavorite');
//             favbtn.addEventListener('click', () => {
//                 window.href = 'favoris.php?title=' + title + '&authors=' + authors + '&imageLinks=' + imageLinks;
//                 });
//             });
//         }
//     } catch (error) {
//         console.error(error);
//     }
// }); // Add closing parenthesis here

// test





