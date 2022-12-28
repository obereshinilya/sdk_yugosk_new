//-------------ДИАЛОГ----------------//
const overlay = document.querySelector('.overlay'),
    modals = document.querySelectorAll('.dlg-modal:not(#new_jas_1_modal)'),
    mClose = document.querySelectorAll('[data-close]:not(.new_jas_1_modal_close_btn)');
let	mStatus = false;

for (let el of mClose) {
    el.addEventListener('click', modalClose);
}

document.addEventListener('keydown', modalClose);

function modalShow(modal) {
    overlay.className='overlay fadeIn';
    modal.className='dlg-modal dlg-modal-slide slideInDown';

    mStatus = true;
}

function modalClose(event) {
    function close(){
        for (let modal of modals) {
            for (let modal of modals) {
                if (modal.className=="dlg-modal dlg-modal-slide slideInDown"){
                    modal.className='dlg-modal dlg-modal-slide slideOutUp'
                }
            }
        }
        overlay.className='overlay fadeOut';
        mStatus = false;
    }
    if (typeof event ==='undefined'){
        if (mStatus){
            close()
        }
    }
    else{
        if (mStatus && ( event.type != 'keydown' || event.keyCode === 27 ) ) {
            close()
        }
    }
}

// export {modalShow, modalClose};
