function esercizioCorrisponde(ex, text) {
	return ex.name.toLowerCase().includes(text.toLowerCase()) && ex.language === 13;
}

function esercizioFiltrato(exercise, text) {
	for (let i = 0; i < exercise.exercises.length; i++) {
		if (esercizioCorrisponde(exercise.exercises[i], text)) {
			return true;
		}
	}
	return false;
}


function fetchAllExerciseBaseData() {
	const limit = 100;
	let offset = 0;
	let allResults = [];

	function fetchData() {
		return fetch(BaseURL+'get_exercises?limit=100&offset=' + offset)
			.then(response => {
				if (!response.ok) {
					throw new Error('HTTP error! status: ' + response.status);
				}
				return response.json();
			})
			.then(data => {
				if (data.results.length === 0) {
					return allResults;
				}
				allResults = allResults.concat(data.results);
				offset += limit;
				return fetchData(); 
			});
	}

	return fetchData().catch(error => {
		throw new Error('Error fetching exercise data: ' + error.message);
	});
}

function processExerciseData(data) {
    const resultsDiv = document.querySelector('#exercise-view');
    while (resultsDiv.firstChild) {
        resultsDiv.removeChild(resultsDiv.firstChild);
    }

   
    const defaultImage = 'images/class-icon-2.png'; 

    for (let i = 0; i < data.length; i++) {
        let exercise = data[i];
        if (exercise.exercises && exercise.exercises.length > 0) {
            let italianExercises = [];
            for (let j = 0; j < exercise.exercises.length; j++) {
                if (exercise.exercises[j].language === 13) {
                    italianExercises.push(exercise.exercises[j]);
                }
            }
            for (let k = 0; k < italianExercises.length; k++) {
                let italianExercise = italianExercises[k];

				let slide = document.createElement('div');
                slide.classList.add('swiper-slide');
                slide.classList.add('slide');

                let img = document.createElement('img');
                img.src = (exercise.images && exercise.images.length > 0) ? exercise.images[0].image : defaultImage;
                img.alt = italianExercise.name;
                slide.appendChild(img);

                let h2 = document.createElement('h2');
                h2.textContent = italianExercise.name;
                slide.appendChild(h2);

                let p = document.createElement('p');
                p.textContent = italianExercise.description;
                slide.appendChild(p);

                
                resultsDiv.appendChild(slide);
            }
			
            
            
        }
    }

	initializeSwiper();
}



function search(event) {
	event.preventDefault();

	const text = document.querySelector('#content').value.toLowerCase();
	const loadingGif= document.querySelector('#loading-gif');

	if (text) {
		console.log('Eseguo ricerca elementi riguardanti: ' + text);
		loadingGif.style.display = 'inline';

		fetchAllExerciseBaseData()
			.then(function(allExercises){
				let filteredExercises = [];
				for (let i = 0; i < allExercises.length; i++) {
					if (esercizioFiltrato(allExercises[i], text)) {
						filteredExercises.push(allExercises[i]);
					}
				}
				processExerciseData(filteredExercises);
				loadingGif.style.display = 'none';
			})
			.catch(onError);
	}
}

function initializeSwiper() {
    new Swiper(".mySwiper", {
        loop: true,
        grabCursor: true,
        spaceBetween: 20,
        breakpoints: {
            550: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });
}



function onError(error) {
	console.log('There was a problem with the fetch operation: ' + error.message);
	loadingGif.style.display = 'none';
}


const form = document.querySelector('#search_content');
form.addEventListener('submit', search);

