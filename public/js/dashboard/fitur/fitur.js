(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/dashboard/fitur/fitur"],{

/***/ "./resources/js/dashboard/fitur/fitur.js":
/*!***********************************************!*\
  !*** ./resources/js/dashboard/fitur/fitur.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);


function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr && (typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]); if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }



function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

var formModal = $('#form-modal');
var formModalTittle = $('#form-modalLabel');
var form = $('#form');
var buttonSubmit = $('button[type="submit"]');

window.deleteData = function (id, name) {
  Swal.fire({
    allowEnterKey: true,
    title: 'Apakah anda yakin ingin menghapus ?',
    text: "Akan menghapus data " + name + " ",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Iya',
    cancelButtonText: 'Tidak',
    showLoaderOnConfirm: true,
    preConfirm: function () {
      var _preConfirm = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
        var response;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.prev = 0;
                _context.next = 3;
                return window.axios["delete"]('fitur/delete/', {
                  data: {
                    id: id
                  }
                });

              case 3:
                response = _context.sent;

                if (!(response.statusText != "OK")) {
                  _context.next = 6;
                  break;
                }

                throw new Error(response.statusText);

              case 6:
                _context.next = 8;
                return response;

              case 8:
                return _context.abrupt("return", _context.sent);

              case 11:
                _context.prev = 11;
                _context.t0 = _context["catch"](0);
                Swal.showValidationMessage("Error: ".concat(_context.t0));

              case 14:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, null, [[0, 11]]);
      }));

      function preConfirm() {
        return _preConfirm.apply(this, arguments);
      }

      return preConfirm;
    }(),
    allowOutsideClick: function allowOutsideClick() {
      return !Swal.isLoading();
    }
  }).then(function (result) {
    if (result.isConfirmed) {
      Swal.fire('Berhasil!', 'Data ' + name + ' telah dihapus!', 'success');
      dataTable.ajax.reload(null, false);
    }
  });
};

$('#action-selected').on('change', function () {
  var value = this.value;

  if (this.value != "") {
    var id = [];
    $.each($("input[name='id']:checked"), function () {
      id.push($(this).val());
    });

    if (id.length == 0) {
      Swal.fire('Error!', 'Pilih setidaknya satu data!', 'error');
    } else {
      deleteOrUpdateSelected(id.join(","), this.value);
    }
  }

  $(this).prop('selectedIndex', 0).selectric('refresh');
  $("#checkbox-all").prop('checked', false);
  $("input[name='id']:checked").prop('checked', false);
});

window.deleteOrUpdateSelected = function (id, value) {
  Swal.fire({
    allowEnterKey: true,
    title: 'Apakah anda yakin ?',
    text: "Data yang dipilih akan dirubah ke " + value + " ",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Iya',
    cancelButtonText: 'Tidak',
    showLoaderOnConfirm: true,
    preConfirm: function () {
      var _preConfirm2 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee2() {
        var response;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.prev = 0;
                response = null;

                if (!(value == "delete")) {
                  _context2.next = 8;
                  break;
                }

                _context2.next = 5;
                return window.axios["delete"]('fitur/delete-selected/', {
                  data: {
                    id: id
                  }
                });

              case 5:
                response = _context2.sent;
                _context2.next = 11;
                break;

              case 8:
                _context2.next = 10;
                return window.axios.post('fitur/update-selected/', {
                  id: id,
                  status: value
                });

              case 10:
                response = _context2.sent;

              case 11:
                if (!(response.statusText != "OK")) {
                  _context2.next = 13;
                  break;
                }

                throw new Error(response.statusText);

              case 13:
                _context2.next = 15;
                return response;

              case 15:
                return _context2.abrupt("return", _context2.sent);

              case 18:
                _context2.prev = 18;
                _context2.t0 = _context2["catch"](0);
                Swal.showValidationMessage("Gagal: ".concat(_context2.t0));

              case 21:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, null, [[0, 18]]);
      }));

      function preConfirm() {
        return _preConfirm2.apply(this, arguments);
      }

      return preConfirm;
    }(),
    allowOutsideClick: function allowOutsideClick() {
      return !Swal.isLoading();
    }
  }).then(function (result) {
    if (result.isConfirmed) {
      if (value == "delete") {
        Swal.fire('Berhasil!', 'Data telah dihapus!', 'success');
      } else {
        Swal.fire('Berhasil!', 'Data telah diubah!', 'success');
      }

      dataTable.ajax.reload(null, false);
    }
  });
}; // MODAL


$('.loading-modal').hide();
formModal.on('hidden.bs.modal', function (event) {
  clearFormModal();
  formModalTittle.html('Tambah Fitur');
  form.attr('action', '/admin/fitur/store');
  buttonSubmit.attr('disabled', false);
  buttonSubmit.text('Simpan');
  $('.loading-modal').hide();
  $('.content-modal').show();
});

window.clearFormModal = function () {
  form.trigger('reset');
  form.removeClass('was-validated');
  $('.is-invalid').removeClass("is-invalid");
};

window.editFormModal = function (id) {
  form.attr('action', '/admin/fitur/update/' + id);
  formModalTittle.html('Edit Fitur');
  buttonSubmit.text('Perbarui');
  formModal.modal('show');
  buttonSubmit.attr('disabled', true);
  $('.loading-modal').show();
  $('.content-modal').hide();
  window.axios.get('fitur/update/' + id).then(function (response) {
    $('.loading-modal').hide();
    $('.content-modal').show();
    buttonSubmit.attr('disabled', false);
    var data = response.data;
    $('input[name="icon"]').val(data.icon);
    $('input[name="name"]').val(data.name);
    $('textarea[name="description"]').val(data.description);
  })["catch"](function (error) {
    console.log(error);
  });
};

form.submit(function (event) {
  event.preventDefault();
  buttonSubmit.attr('disabled', true);
  $('.loading-modal').show();
  $('.content-modal').hide();
  var bodyFormData = new FormData(this);
  window.axios.post($(this).attr('action'), bodyFormData).then(function (response) {
    var data = response.data;
    formModal.modal('hide');

    if (buttonSubmit.text() == "Simpan") {
      dataTable.order([1, 'desc']).draw();
    } else {
      dataTable.ajax.reload(null, false);
    }

    Swal.fire('Berhasil', data.message, 'success');
  })["catch"](function (error) {
    console.log(error);
    buttonSubmit.attr('disabled', false);
    $('.loading-modal').hide();
    $('.content-modal').show();

    if (data.status != 422) {
      Swal.fire('Error', error.message, 'error');
    } else {
      for (var _i = 0, _Object$entries = Object.entries(data.data.errors); _i < _Object$entries.length; _i++) {
        var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
            key = _Object$entries$_i[0],
            value = _Object$entries$_i[1];

        $("[name='" + key + "']").closest(".form-group").find(".invalid-feedback").text(value);
      }
    }
  });
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ "use strict";
/******/ 
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["/js/dashboard/vendor"], () => (__webpack_exec__("./resources/js/dashboard/fitur/fitur.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);