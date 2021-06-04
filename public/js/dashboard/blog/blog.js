(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/dashboard/blog/blog"],{

/***/ "./resources/js/dashboard/blog/blog.js":
/*!*********************************************!*\
  !*** ./resources/js/dashboard/blog/blog.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);




function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

window.countData = function () {
  window.axios.get('blog/count-data/').then(function (response) {
    var data = response.data;
    document.getElementById("all").innerHTML = data.all;
    document.getElementById("draft").innerHTML = data.draft;
    document.getElementById("published").innerHTML = data.published;
    document.getElementById("archived").innerHTML = data.archived;
  })["catch"](function (error) {
    console.log(error);
  });
};

countData();

window.filterDataTable = function (a) {
  var element = document.getElementById('filter_active');
  element.id = "";
  element.classList.remove('active');
  element.children[0].classList.remove('badge-white');
  element.children[0].classList.add('badge-primary');
  a.id = "filter_active";
  a.classList.add("active");
  a.children[0].classList.remove('badge-primary');
  a.children[0].classList.add('badge-white');
  status = $("#filter_active").attr("data-filter");
  dataTable.draw();
};

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
                return window.axios["delete"]('blog/delete/', {
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
      countData();
      dataTable.ajax.reload(null, false);
    }
  });
};

window.actionSelected = function (value) {
  if (value != "") {
    var id = [];
    $.each($("input[name='id']:checked"), function () {
      id.push($(this).val());
    });

    if (id.length == 0) {
      Swal.fire('Error!', 'Pilih setidaknya satu data!', 'error');
    } else {
      deleteOrUpdateSelected(id.join(","), value);
    }
  }

  $("#checkbox-all").prop('checked', false);
  $("input[name='id']:checked").prop('checked', false);
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
                return window.axios["delete"]('blog/delete-selected/', {
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
                return window.axios.post('blog/update-selected/', {
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

      countData();
      dataTable.ajax.reload(null, false);
    }
  });
};

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ "use strict";
/******/ 
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["/js/dashboard/vendor"], () => (__webpack_exec__("./resources/js/dashboard/blog/blog.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);