let postalCache = null;
function setSameAsPhysical()
{

    let physical_address = {
        aline1: document.getElementById('physical_aline_1').value,
        aline2: document.getElementById('physical_aline2').value,
        city: document.getElementById('physical_city').value,
        zip_code: document.getElementById('physical_zip').value
    };

    let postal_address = {
        aline1: document.getElementById('postal_aline1').value,
        aline2: document.getElementById('postal_aline2').value,
        city: document.getElementById('postal_city').value,
        zip_code: document.getElementById('postal_zip_code').value
    }

    postalCache = postal_address;

    


    


}