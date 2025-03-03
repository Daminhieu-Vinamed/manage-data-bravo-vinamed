!(function (e, t) {
    "object" == typeof exports && "object" == typeof module
        ? (module.exports = t(require("moment"), require("fullcalendar")))
        : "function" == typeof define && define.amd
        ? define(["moment", "fullcalendar"], t)
        : "object" == typeof exports
        ? t(require("moment"), require("fullcalendar"))
        : t(e.moment, e.FullCalendar);
})("undefined" != typeof self ? self : this, function (n, h) {
    return (
        (a = {}),
        (T.m = r =
            {
                0: function (e, t) {
                    e.exports = n;
                },
                1: function (e, t) {
                    e.exports = h;
                },
                209: function (e, t, n) {
                    Object.defineProperty(t, "__esModule", { value: !0 }),
                        n(210);
                    var h = n(1);
                    h.datepickerLocale("vi", "vi", {
                        closeText: "Đóng",
                        prevText: "&#x3C;Trước",
                        nextText: "Tiếp&#x3E;",
                        currentText: "Hôm nay",
                        monthNames: [
                            "Tháng Một",
                            "Tháng Hai",
                            "Tháng Ba",
                            "Tháng Tư",
                            "Tháng Năm",
                            "Tháng Sáu",
                            "Tháng Bảy",
                            "Tháng Tám",
                            "Tháng Chín",
                            "Tháng Mười",
                            "Tháng Mười Một",
                            "Tháng Mười Hai",
                        ],
                        monthNamesShort: [
                            "Tháng 1",
                            "Tháng 2",
                            "Tháng 3",
                            "Tháng 4",
                            "Tháng 5",
                            "Tháng 6",
                            "Tháng 7",
                            "Tháng 8",
                            "Tháng 9",
                            "Tháng 10",
                            "Tháng 11",
                            "Tháng 12",
                        ],
                        dayNames: [
                            "Chủ Nhật",
                            "Thứ Hai",
                            "Thứ Ba",
                            "Thứ Tư",
                            "Thứ Năm",
                            "Thứ Sáu",
                            "Thứ Bảy",
                        ],
                        dayNamesShort: [
                            "CN",
                            "T2",
                            "T3",
                            "T4",
                            "T5",
                            "T6",
                            "T7",
                        ],
                        dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                        weekHeader: "Tu",
                        dateFormat: "dd/mm/yy",
                        firstDay: 0,
                        isRTL: !1,
                        showMonthAfterYear: !1,
                        yearSuffix: "",
                    }),
                        h.locale("vi", {
                            buttonText: {
                                month: "Tháng",
                                week: "Tuần",
                                day: "Ngày",
                                list: "Lịch biểu",
                            },
                            allDayText: "Cả ngày",
                            eventLimitText: function (e) {
                                return "+ thêm " + e;
                            },
                            noEventsMessage: "Không có sự kiện để hiển thị",
                        });
                },
                210: function (e, t, n) {
                    n(0).defineLocale("vi", {
                        months: "Tháng 1_Tháng 2_Tháng 3_Tháng 4_Tháng 5_Tháng 6_Tháng 7_Tháng 8_Tháng 9_Tháng 10_Tháng 11_Tháng 12".split(
                            "_"
                        ),
                        monthsShort:
                            "Th01_Th02_Th03_Th04_Th05_Th06_Th07_Th08_Th09_Th10_Th11_Th12".split(
                                "_"
                            ),
                        monthsParseExact: !0,
                        weekdays:
                            "chủ nhật_thứ hai_thứ ba_thứ tư_thứ năm_thứ sáu_thứ bảy".split(
                                "_"
                            ),
                        weekdaysShort: "CN_T2_T3_T4_T5_T6_T7".split("_"),
                        weekdaysMin: "CN_T2_T3_T4_T5_T6_T7".split("_"),
                        weekdaysParseExact: !0,
                        meridiemParse: /sa|ch/i,
                        isPM: function (e) {
                            return /^ch$/i.test(e);
                        },
                        meridiem: function (e, t, n) {
                            return e < 12 ? (n ? "am" : "AM") : n ? "pm" : "PM";
                        },
                        longDateFormat: {
                            LT: "HH:mm",
                            LTS: "HH:mm:ss",
                            L: "DD/MM/YYYY",
                            LL: "D MMMM [năm] YYYY",
                            LLL: "D MMMM [năm] YYYY HH:mm",
                            LLLL: "dddd, D MMMM [năm] YYYY HH:mm",
                            l: "DD/M/YYYY",
                            ll: "D MMM YYYY",
                            lll: "D MMM YYYY HH:mm",
                            llll: "ddd, D MMM YYYY HH:mm",
                        },
                        calendar: {
                            sameDay: "[Hôm nay lúc] LT",
                            nextDay: "[Ngày mai lúc] LT",
                            nextWeek: "dddd [tuần tới lúc] LT",
                            lastDay: "[Hôm qua lúc] LT",
                            lastWeek: "dddd [tuần trước lúc] LT",
                            sameElse: "L",
                        },
                        relativeTime: {
                            future: "%s tới",
                            past: "%s trước",
                            s: "vài giây",
                            ss: "%d giây",
                            m: "một phút",
                            mm: "%d phút",
                            h: "một giờ",
                            hh: "%d giờ",
                            d: "một ngày",
                            dd: "%d ngày",
                            M: "một tháng",
                            MM: "%d tháng",
                            y: "một năm",
                            yy: "%d năm",
                        },
                        dayOfMonthOrdinalParse: /\d{1,2}/,
                        ordinal: function (e) {
                            return e;
                        },
                        week: { dow: 1, doy: 4 },
                    });
                },
            }),
        (T.c = a),
        (T.d = function (e, t, n) {
            T.o(e, t) ||
                Object.defineProperty(e, t, {
                    configurable: !1,
                    enumerable: !0,
                    get: n,
                });
        }),
        (T.n = function (e) {
            var t =
                e && e.__esModule
                    ? function () {
                          return e.default;
                      }
                    : function () {
                          return e;
                      };
            return T.d(t, "a", t), t;
        }),
        (T.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t);
        }),
        (T.p = ""),
        T((T.s = 209))
    );
    function T(e) {
        if (a[e]) return a[e].exports;
        var t = (a[e] = { i: e, l: !1, exports: {} });
        return r[e].call(t.exports, t, t.exports, T), (t.l = !0), t.exports;
    }
    var r, a;
});
