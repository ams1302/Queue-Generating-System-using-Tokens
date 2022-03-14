var id = [];
var prevKeyword;

function showResult() {
    const keywordVal = document.getElementById('search').value;
    const results = document.querySelectorAll('.result-row');
    document.querySelector('.search-result').style.display = 'block';

    if (prevKeyword == keywordVal) {
        return;
    }
    if (keywordVal.length < 3) {
        results.forEach(row => {
            row.remove();
        });
        return;
    }

    id = [];
    prevKeyword = keywordVal;
    results.forEach(row => {
        row.remove();
    });

    $.ajax({
        url: 'getData.php',
        method: 'GET',
        success: function(data) {
            data = JSON.parse(data);
            data.forEach(arr => {
                for (const key of Object.keys(arr)) {
                    if (arr[key].toUpperCase().includes(keywordVal.toUpperCase()) && !id.includes(arr.id)) {
                        id.push(arr.id);
                        let html = `<div class="result-row mt-1"><span class="d-none">${arr.id}</span><span>${arr.name}</span>
                        <span>${arr.email}</span><span>${arr.qualification}</span><span>(${arr.specialty})</span>
                        <span>${arr.startTime}-${arr.endTime}</span></div>`;
                        document.querySelector('.search-result').insertAdjacentHTML('beforeend', html);
                    }
                }
            });
        },
        failure: function(data) {
            alert('Got an error!');
        }
    });
}
let element = document.getElementById('search');
['keyup', 'keypress', 'click', 'mouseout'].forEach(event => element.addEventListener(event, showResult));


var resultRow;
document.body.addEventListener('click', e => {
    if (e.target.className.includes('result-row') || e.target.parentNode.className.includes('result-row')) {

        let text, index1, index2, specialty, name, email, qualification, time, id, data, html;

        if (e.target.parentNode.className.includes('result-row')) {
            id = e.target.parentNode.childNodes[0].innerText;
            text = e.target.parentNode.outerHTML;
        } else {
            id = e.target.childNodes[0].innerText;
            text = e.target.outerHTML;
        }

        const keyword1 = '<span>';
        const keyword2 = '</span>';
        console.log(text);
        text = text.replace(text.substring(0, text.indexOf(keyword2) + keyword2.length), '');
        const len = text.split(keyword1).length - 1;
        var doctorInfo = [];
        for (var i = 0; i < len; i++) {

            index1 = text.indexOf(keyword1);
            index2 = text.indexOf(keyword2);
            data = text.substring(index1 + keyword1.length, index2);
            text = text.replace(text.substring(0, index2 + keyword2.length), '');
            doctorInfo.push(data);
            console.log(data);
        }
        console.log(doctorInfo);
        name = doctorInfo[0];
        email = doctorInfo[1];
        qualification = doctorInfo[2];
        specialty = doctorInfo[3];
        time = doctorInfo[4];

        html = `<form class="profile" action="appointment.php" method="POST">
            <input type="text" name="id" value="${id}" hidden>        
            <span><strong>${name}</strong></span>
            <span>${qualification}</span>
            <span>${specialty}</span>
            <span>Email: ${email}</span>
            <span>Visiting hour: ${time}</span>
            <span><input type="submit" class="btn btn-outline-light mt-2" value="Appointment" name="fixedDoctor"></span>
        </form>`;
        document.querySelector('.search-result').style.display = 'none';
        document.querySelector('.list').insertAdjacentHTML('beforeend', html);

    }
});