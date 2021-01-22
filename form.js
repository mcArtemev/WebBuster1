 'use strict';

document.body.innerHTML += `
    <div class="form-wrapper" onClick="callback_form('none');">
        <form class="contact-form" id="contact-form_1" method="POST" enctype="multipart/form-data">
            <p class="contact-form__title">Оставьте заявку и вам перезвонят</p>
            <p class="contact-form__description"></p>
            <div class="contact-form__input-wrapper">
                <input name="name" type="text" class="contact-form__input contact-form__input_name"
                    placeholder="Введите ваше имя">
                <div class="contact-form__error contact-form__error_name"></div>
            </div>
            
            <div class="contact-form__input-wrapper">
                <input name="tel" id="phone_2020" type="tel" class="contact-form__input contact-form__input_tel"
                    value="+7 (___)___-__-__"
                    placeholder="Введите ваш телефон">
                <div class="contact-form__error contact-form__error_tel"></div>
            </div>

            <div class="contact-form__input-wrapper"> 
                <input name="email" type="email" class="contact-form__input contact-form__input_email"
                    placeholder="Введите ваш email">
                <div class="contact-form__error contact-form__error_email"></div>
            </div>
            <p id="responce_form"></p>
            <button class="contact-form__button" type="submit" onClick="sendciba();"> Заказать звонок </button>
            
        </form>
        
    </div>
`;
