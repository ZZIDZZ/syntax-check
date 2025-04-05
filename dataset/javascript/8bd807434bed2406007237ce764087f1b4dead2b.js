function getMousePosition(e) {
                var mouseObj = void 0,
                    originalEvent = e.originalEvent ? e.originalEvent : e;
                mouseObj = 'changedTouches' in originalEvent && originalEvent.changedTouches ? originalEvent.changedTouches[0] : originalEvent;
                // clientX, Y 쓰면 스크롤에서 문제 발생
                return {
                    clientX: mouseObj.pageX,
                    clientY: mouseObj.pageY
                };
            }