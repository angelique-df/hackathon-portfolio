// if user refuses consent
    //exit
// if user accepts
    //we start by collecting the current datetime, referrer, and links clicked in an array
        //getCurrentTime()
        //getReferrer()
        //datetime and referrer are send to database
        
        //links clicked are sent on unload when user leaves
            //onbeforeunload/onunload
                //get time of exit
                //get visit duration
    //contact form
        //select elements
            //query select inputs, textarea

let userConsent = false;
//if user gives their consent, start tracking
export function setConsentTrue(userConsent){
    userConsent = true;
    // console.log(userConsent)
    return userConsent;
}
// export function setConsentFalse(userConsent){
//     userConsent = false;
//     return userConsent;
// }
// //if user does not give their consent, stop tracking
export function stopTracking(){
    return;
}
//hide consent dialog box
export function hideConsentDialog(){
    let consentDialog = document.querySelector('.consent');
    consentDialog.style.display = 'none'
}


//get time when visitor leaves page
export function getExitDate(){
    let date = new Date();
    return date
}
document.getElementById('refuse-tracking').addEventListener("click", () => {
    hideConsentDialog();
    stopTracking()
});
//store current time
export function storeExitDate(date){
    let datetime = date;
    
    //send to database
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            console.log("exitdate if loaded");
        }
    }
    xml.open('POST', './app/php/Models/StoreExitDate.php', true);
    xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xml.send('exitdate=' + datetime)

}
//get current time
export function getCurrentDatetime(){
    return Math.round((new Date()).getTime() / 1000);
}
//get source
export function getReferrer(){
    let referrer = document.referrer;
    return referrer;
}
export function setCookie(){
    let uniqueId = Date.now()
    console.log(uniqueId)
    document.cookie = "uniqueId=" + uniqueId + "; expires=Sat, 30 May 2020 12:00:00 UTC";
    return uniqueId
}
//store current time
export function storeVisitorEntryInfo(timestamp, referrer, idCookie){
    let datetime = JSON.stringify(timestamp)
    let sourceUrl = JSON.stringify(referrer)
    let userId = JSON.stringify(idCookie)
    
    //send to database
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            console.log("storeVisitorEntryInfo if loaded");
        }
    }
    xml.open('POST', './app/php/Models/StoreEntryData.php', true);
    xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xml.send('entrydate=' + datetime + '&' + 'referrer='+ sourceUrl + '&' + 'userid='+ userId)
}
//watch link clicks and send clicked links destination to backend for analytics 
export let destinations = function(){
    //select all links
    let onPageLinks = document.querySelectorAll('a');
    let destinations = [];

    //onclick, store destination
    onPageLinks.forEach(element => {
        function getAnchorDestination(){
            //store all links clicked in array
            destinations.push(element.getAttribute('href'))
            console.log(destinations)

            return destinations
        }
        element.addEventListener('click', getAnchorDestination)
    });
    return destinations
}
//array of links clicked during visit
export function storeLinksClicked(links, visitorIdCookie){
    let linksClicked = JSON.stringify(links);
    let userId = visitorIdCookie;
    //send to database
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            console.log(linksClicked, "if loaded");
        }
    }
    xml.open('POST', './app/php/Models/StoreLinksClicked.php', true);
    xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xml.send('linksclicked=' + linksClicked + '&' + 'userid='+ userId)
}
//user agrees to tracking
export function startTracking(userConsent){
    let consent = userConsent
    consent = setConsentTrue(consent)
    if(consent === true){

        let unixTimestamp = getCurrentDatetime()
        let referrer = getReferrer();
        let visitorIdCookie = setCookie();
        storeVisitorEntryInfo(unixTimestamp, referrer, visitorIdCookie);
        
        let linksClicked = destinations()

        window.addEventListener('pagehide', () => {
            storeLinksClicked(linksClicked, visitorIdCookie)

            let exitDate = getCurrentDatetime()
            storeExitDate(exitDate)
        });
    }else{
        return
    }
};
document.getElementById('accept-tracking').addEventListener("click", () => {
    hideConsentDialog();
    startTracking(userConsent);
});

