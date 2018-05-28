var brushSize = 10;
var sizeText = document.getElementById("sizeText");
function smallSize() {
    brushSize = 5;
    sizeText.innerHTML = "Small";
}

function mediumSize() {
    brushSize = 10;
    sizeText.innerHTML = "Medium";
}

function largeSize() {
    brushSize = 15;
    sizeText.innerHTML = "Large";
}
(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
        typeof define === 'function' && define.amd ? define(factory) :
            (global.CanvasPad = factory());
}(this, (function () {
    'use strict';

    function Point(x, y, time) {
        this.x = x;
        this.y = y;
        this.time = time || new Date().getTime();
    }

    Point.prototype.distanceTo = function (start) {
        return Math.sqrt(Math.pow(this.x - start.x, 2) + Math.pow(this.y - start.y, 2));
    };

    Point.prototype.equals = function (other) {
        return this.x === other.x && this.y === other.y && this.time === other.time;
    };

    function Bezier(startPoint, control1, control2, endPoint) {
        this.startPoint = startPoint;
        this.control1 = control1;
        this.control2 = control2;
        this.endPoint = endPoint;
    }

// Returns approximated length.
    Bezier.prototype.length = function () {
        var steps = 10;
        var length = 0;
        var px = void 0;
        var py = void 0;

        for (var i = 0; i <= steps; i += 1) {
            var t = i / steps;
            var cx = this._point(t, this.startPoint.x, this.control1.x, this.control2.x, this.endPoint.x);
            var cy = this._point(t, this.startPoint.y, this.control1.y, this.control2.y, this.endPoint.y);
            if (i > 0) {
                var xdiff = cx - px;
                var ydiff = cy - py;
                length += Math.sqrt(xdiff * xdiff + ydiff * ydiff);
            }
            px = cx;
            py = cy;
        }
        return length;
    };

    /* eslint-disable no-multi-spaces, space-in-parens */
    Bezier.prototype._point = function (t, start, c1, c2, end) {
        return start * (1.0 - t) * (1.0 - t) * (1.0 - t) + 3.0 * c1 * (1.0 - t) * (1.0 - t) * t + 3.0 * c2 * (1.0 - t) * t * t + end * t * t * t;
    };

    /* eslint-disable */
    function throttle(func, wait, options) {
        var context, args, result;
        var timeout = null;
        var previous = 0;
        if (!options) options = {};
        var later = function later() {
            previous = options.leading === false ? 0 : Date.now();
            timeout = null;
            result = func.apply(context, args);
            if (!timeout) context = args = null;
        };
        return function () {
            var now = Date.now();
            if (!previous && options.leading === false) previous = now;
            var remaining = wait - (now - previous);
            context = this;
            args = arguments;
            if (remaining <= 0 || remaining > wait) {
                if (timeout) {
                    clearTimeout(timeout);
                    timeout = null;
                }
                previous = now;
                result = func.apply(context, args);
                if (!timeout) context = args = null;
            } else if (!timeout && options.trailing !== false) {
                timeout = setTimeout(later, remaining);
            }
            return result;
        };
    }

    function CanvasPad(canvas, options) {
        var self = this;
        var opts = options || {};
        this.minWidth = opts.minWidth;
        this.maxWidth = opts.maxWidth;
        this.throttle = 'throttle' in opts ? opts.throttle : 16; // in miliseconds
        this.minDistance = 'minDistance' in opts ? opts.minDistance : 5;

        if (this.throttle) {
            this._strokeMoveUpdate = throttle(CanvasPad.prototype._strokeUpdate, this.throttle);
        } else {
            this._strokeMoveUpdate = CanvasPad.prototype._strokeUpdate;
        }

        this.dotSize = opts.dotSize || function () {
            return (this.minWidth + this.maxWidth) / 2;
        };
        this.penColor = opts.penColor || 'black';
        this.backgroundColor = opts.backgroundColor || 'rgba(0,0,0,0)';
        this.onBegin = opts.onBegin;
        this.onEnd = opts.onEnd;

        this._canvas = canvas;
        this._ctx = canvas.getContext('2d');
        this.clear();

        this._handleMouseDown = function (event) {
            if (event.which === 1) {
                self._mouseButtonDown = true;
                self._strokeBegin(event);
            }
        };

        this._handleMouseMove = function (event) {
            if (self._mouseButtonDown) {
                self._strokeMoveUpdate(event);
            }
        };

        this._handleMouseUp = function (event) {
            if (event.which === 1 && self._mouseButtonDown) {
                self._mouseButtonDown = false;
                self._strokeEnd(event);
            }
        };
        // Enable mouse event handlers
        this.on();
    }

    CanvasPad.prototype.clear = function () {
        var ctx = this._ctx;
        var canvas = this._canvas;

        ctx.fillStyle = this.backgroundColor;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        this._data = [];
        this._reset();
        this._isEmpty = true;
    };

    CanvasPad.prototype.fromDataURL = function (dataUrl) {
        var _this = this;

        var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

        var image = new Image();
        var ratio = options.ratio || window.devicePixelRatio || 1;
        var width = options.width || this._canvas.width / ratio;
        var height = options.height || this._canvas.height / ratio;

        this._reset();
        image.src = dataUrl;
        image.onload = function () {
            _this._ctx.drawImage(image, 0, 0, width, height);
        };
        this._isEmpty = false;
    };

    CanvasPad.prototype.toDataURL = function (type) {
        var _canvas;
        for (var _len = arguments.length, options = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
            options[_key - 1] = arguments[_key];
        }
        return (_canvas = this._canvas).toDataURL.apply(_canvas, [type].concat(options));
    };

    CanvasPad.prototype.on = function () {
        this._handleMouseEvents();
    };

    CanvasPad.prototype.off = function () {
        this._canvas.removeEventListener('mousedown', this._handleMouseDown);
        this._canvas.removeEventListener('mousemove', this._handleMouseMove);
        document.removeEventListener('mouseup', this._handleMouseUp);
    };

    CanvasPad.prototype.isEmpty = function () {
        return this._isEmpty;
    };

    CanvasPad.prototype._strokeBegin = function (event) {
        this._data.push([]);
        this._reset();
        this._strokeUpdate(event);

        if (typeof this.onBegin === 'function') {
            this.onBegin(event);
        }
    };

    CanvasPad.prototype._strokeUpdate = function (event) {
        var x = event.clientX;
        var y = event.clientY;

        var point = this._createPoint(x, y);
        var lastPointGroup = this._data[this._data.length - 1];
        var lastPoint = lastPointGroup && lastPointGroup[lastPointGroup.length - 1];
        var isLastPointTooClose = lastPoint && point.distanceTo(lastPoint) < this.minDistance;

        // Skip this point if it's too close to the previous one
        if (!(lastPoint && isLastPointTooClose)) {
            var _addPoint = this._addPoint(point),
                curve = _addPoint.curve,
                widths = _addPoint.widths;

            if (curve && widths) {
                this._drawCurve(curve, widths.start, widths.end);
            }

            this._data[this._data.length - 1].push({
                x: point.x,
                y: point.y,
                time: point.time,
                color: this.penColor
            });
        }
    };

    CanvasPad.prototype._strokeEnd = function (event) {
        var canDrawCurve = this.points.length > 2;
        var point = this.points[0]; // Point instance

        if (!canDrawCurve && point) {
            this._drawDot(point);
        }

        if (point) {
            var lastPointGroup = this._data[this._data.length - 1];
            var lastPoint = lastPointGroup[lastPointGroup.length - 1]; // plain object

            // When drawing a dot, there's only one point in a group, so without this check
            // such group would end up with exactly the same 2 points.
            if (!point.equals(lastPoint)) {
                lastPointGroup.push({
                    x: point.x,
                    y: point.y,
                    time: point.time,
                    color: this.penColor
                });
            }
        }

        if (typeof this.onEnd === 'function') {
            this.onEnd(event);
        }
    };

    CanvasPad.prototype._handleMouseEvents = function () {
        this._mouseButtonDown = false;
        this._canvas.addEventListener('mousedown', this._handleMouseDown);
        this._canvas.addEventListener('mousemove', this._handleMouseMove);
        document.addEventListener('mouseup', this._handleMouseUp);
    };

    CanvasPad.prototype._reset = function () {
        this.points = [];
        this._lastWidth = (this.minWidth + this.maxWidth) / 2;
        this._ctx.fillStyle = this.penColor;
    };

    CanvasPad.prototype._createPoint = function (x, y, time) {
        var rect = this._canvas.getBoundingClientRect();

        return new Point(x - rect.left, y - rect.top, time || new Date().getTime());
    };

    CanvasPad.prototype._addPoint = function (point) {
        var points = this.points;
        var tmp = void 0;

        points.push(point);

        if (points.length > 2) {
            // To reduce the initial lag make it work with 3 points
            // by copying the first point to the beginning.
            if (points.length === 3) points.unshift(points[0]);

            tmp = this._calculateCurveControlPoints(points[0], points[1], points[2]);
            var c2 = tmp.c2;
            tmp = this._calculateCurveControlPoints(points[1], points[2], points[3]);
            var c3 = tmp.c1;
            var curve = new Bezier(points[1], c2, c3, points[2]);
            var widths = this._calculateCurveWidths(curve);

            // Remove the first element from the list,
            // so that we always have no more than 4 points in points array.
            points.shift();

            return {curve: curve, widths: widths};
        }

        return {};
    };

    CanvasPad.prototype._calculateCurveControlPoints = function (s1, s2, s3) {
        var dx1 = s1.x - s2.x;
        var dy1 = s1.y - s2.y;
        var dx2 = s2.x - s3.x;
        var dy2 = s2.y - s3.y;

        var m1 = {x: (s1.x + s2.x) / 2.0, y: (s1.y + s2.y) / 2.0};
        var m2 = {x: (s2.x + s3.x) / 2.0, y: (s2.y + s3.y) / 2.0};

        var l1 = Math.sqrt(dx1 * dx1 + dy1 * dy1);
        var l2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);

        var dxm = m1.x - m2.x;
        var dym = m1.y - m2.y;

        var k = l2 / (l1 + l2);
        var cm = {x: m2.x + dxm * k, y: m2.y + dym * k};

        var tx = s2.x - cm.x;
        var ty = s2.y - cm.y;

        return {
            c1: new Point(m1.x + tx, m1.y + ty),
            c2: new Point(m2.x + tx, m2.y + ty)
        };
    };




    CanvasPad.prototype._calculateCurveWidths = function (curve) {
        var widths = {start: null, end: null};
        var newWidth = brushSize;
        widths.start = this._lastWidth;
        widths.end = newWidth;
        this._lastWidth = brushSize;
        return widths;
    };

    CanvasPad.prototype._drawDot = function (point) {
        var ctx = this._ctx;
        var width = brushSize;
        ctx.beginPath();
        this._drawPoint(point.x, point.y, width);
        ctx.closePath();
        ctx.fill();
    };

    CanvasPad.prototype._drawPoint = function (x, y, size) {
        var ctx = this._ctx;
        ctx.moveTo(x, y);
        ctx.arc(x, y, size, 0, 2 * Math.PI, false);
        this._isEmpty = false;
    };

    CanvasPad.prototype._drawCurve = function (curve, startWidth, endWidth) {
        var ctx = this._ctx;
        var widthDelta = endWidth - startWidth;
        var drawSteps = Math.floor(curve.length());

        ctx.beginPath();

        for (var i = 0; i < drawSteps; i += 1) {
            // Calculate the Bezier (x, y) coordinate for this step.
            var t = i / drawSteps;
            var tt = t * t;
            var ttt = tt * t;
            var u = 1 - t;
            var uu = u * u;
            var uuu = uu * u;

            var x = uuu * curve.startPoint.x;
            x += 3 * uu * t * curve.control1.x;
            x += 3 * u * tt * curve.control2.x;
            x += ttt * curve.endPoint.x;

            var y = uuu * curve.startPoint.y;
            y += 3 * uu * t * curve.control1.y;
            y += 3 * u * tt * curve.control2.y;
            y += ttt * curve.endPoint.y;

            var width = startWidth;
            this._drawPoint(x, y, width);
        }

        ctx.closePath();
        ctx.fill();
    };

    CanvasPad.prototype._fromData = function (pointGroups, drawCurve, drawDot) {
        for (var i = 0; i < pointGroups.length; i += 1) {
            var group = pointGroups[i];

            if (group.length > 1) {
                for (var j = 0; j < group.length; j += 1) {
                    var rawPoint = group[j];
                    var point = new Point(rawPoint.x, rawPoint.y, rawPoint.time);
                    var color = rawPoint.color;

                    if (j === 0) {
                        // First point in a group. Nothing to draw yet.

                        // All points in the group have the same color, so it's enough to set
                        // penColor just at the beginning.
                        this.penColor = color;
                        this._reset();

                        this._addPoint(point);
                    } else if (j !== group.length - 1) {
                        // Middle point in a group.
                        var _addPoint2 = this._addPoint(point),
                            curve = _addPoint2.curve,
                            widths = _addPoint2.widths;

                        if (curve && widths) {
                            drawCurve(curve, widths, color);
                        }
                    } else {
                        // Last point in a group. Do nothing.
                    }
                }
            } else {
                this._reset();
                var _rawPoint = group[0];
                drawDot(_rawPoint);
            }
        }
    };

    CanvasPad.prototype.fromData = function (pointGroups) {
        var _this3 = this;

        this.clear();

        this._fromData(pointGroups, function (curve, widths) {
            return _this3._drawCurve(curve, widths.start, widths.end);
        }, function (rawPoint) {
            return _this3._drawDot(rawPoint);
        });

        this._data = pointGroups;
    };

    CanvasPad.prototype.toData = function () {
        return this._data;
    };

    return CanvasPad;

})));
