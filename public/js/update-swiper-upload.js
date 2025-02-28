// const uploadPlaceholder = document.getElementById("upload-placeholder");
// uploadPlaceholder.remove();


const uploadSwiper = document.getElementById("swiper-upload")
const photo = document.getElementById("photo")
let images = document.querySelectorAll(".temp-photo")
let swiperSlide = document.createElement('div')
let image = null
let imageElement = document.createElement('img');
let i = 1

function update_swiper() {
    uploadSwiper.innerHTML = "";
    console.log("da")
    images = document.querySelectorAll(".temp-photo")
    console.log(images)
    i = 1

    images.forEach(img => {
        i++
        swiperSlide = document.createElement('div')
        swiperSlide.className = "swiper-slide";
        imageElement = document.createElement('img');
        imageElement.className = "bg-black w-full h-full max-w-[800px] h-full";
        imageElement.src = img.src;

        uploadSwiper.append(swiperSlide)
        swiperSlide.append(imageElement)

        swiper.init();
        swiper.update();

    });

    swiper.init();
    swiper.update();
}


