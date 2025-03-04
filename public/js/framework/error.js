let task_error = document.getElementById("taskerror");

let position;
let return_position;
if(task_error.classList.contains('top-right') || task_error.classList.contains('bot-right')) 
{
    position = 'to_right';
    return_position = 'back_right'
}
else if (task_error.classList.contains('top-left') || task_error.classList.contains('bot-left'))
{
    position = 'to_left';
    return_position = 'back_left'
}

task_error.addEventListener("click", (e) => {


    let arrayerror = document.getElementById("arrayerror")
    if(arrayerror)
    {
        if(arrayerror.classList.contains('d-none'))
        {
            arrayerror.classList.remove('d-none');
            // animation d'arrivé en fonction de la position du bouton des erreurs
            arrayerror.classList.add(position);

            
            setTimeout(() => {
                document.getElementById('closeerror').addEventListener('click', closeError);

                // code à revoir
                document.getElementsByTagName('header')[0].addEventListener('click', closeError);
                document.getElementsByTagName('main')[0].addEventListener('click', closeError);
                document.getElementsByTagName('footer')[0].addEventListener('click', closeError);
            }, 1500);
            
        }
    }
});

/**
 * 
 */
function closeError()
{
    arrayerror.classList.remove(position);
    arrayerror.classList.add(return_position);
    setTimeout(() => {
        arrayerror.classList.remove(return_position);
        arrayerror.classList.add(position);
        arrayerror.classList.add('d-none');
        document.getElementById('closeerror').removeEventListener('click', closeError);   

        // code à revoir
        document.getElementsByTagName('header')[0].removeEventListener('click', closeError);
        document.getElementsByTagName('main')[0].removeEventListener('click', closeError);
        document.getElementsByTagName('footer')[0].removeEventListener('click', closeError);
    }, 1500);
}