(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/dashboard/blog/update"],{

/***/ "./resources/js/dashboard/blog/update.js":
/*!***********************************************!*\
  !*** ./resources/js/dashboard/blog/update.js ***!
  \***********************************************/
/***/ (() => {

"use strict";


window.readURL = function (input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('.img-thumbnail').attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
};

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ "use strict";
/******/ 
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ var __webpack_exports__ = (__webpack_exec__("./resources/js/dashboard/blog/update.js"));
/******/ }
]);