const search = document.querySelector('.search');
const go = document.querySelector('.go');
const books = document.querySelector('.books');
const genre = document.querySelector('.genre');
const add = document.querySelector('.add-to-favorite');
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
            const html = `
                <form action="" method="post">
                <img value="poster" src="${imageLinks.thumbnail}" alt="poster">
                <p value="author">Auteur : ${authors}</p> 
                <p value="title" class="title">${truncatedTitle}</p>
                <input type="submit" name=addfavorite value="Add to Favorite">
                </form>
            `;
            console.log(html);
            const bookElement = document.createElement('div');
            bookElement.innerHTML = html;
            books.appendChild(bookElement);

            

            });
        } catch (error) {
            console.error(error);
        }
    });

// go.addEventListener('click', async () => {
//     const bookgenre = genre.value;
//     console.log(bookgenre);
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
//                 <input type="submit" name=addfavorite value="Add to Favorite">
//                 </form>
//             `;
//             const bookElement = document.createElement('div');
//             bookElement.innerHTML = html;
//             books.appendChild(bookElement);
//         });
//     } catch (error) {
//         console.error(error);
        
//     }
// }
// );

// add.addEventListener('click', () => {
//     const title = document.querySelector('.title').textContent;
//     const existingBooks = JSON.parse(localStorage.getItem('books')) || [];
//     existingBooks.push({ title });
//     localStorage.setItem('books', JSON.stringify(existingBooks));
// });

// function displayBooksFromLocalStorage() {
//     const books = JSON.parse(localStorage.getItem('books')) || [];

//     favoris.innerHTML = '';

//     books.forEach(book => {
//         const html = `
//             <h1>${book.title}</h1>
//         `;
//         const bookElement = document.createElement('div');
//         bookElement.innerHTML = html;
//         favoris.appendChild(bookElement);
//     });
// }

