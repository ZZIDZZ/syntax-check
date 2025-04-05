def cover?(point)
			p = [point.lat - @nw.lat, point.lng - @se.lng]

			p21x = p[0] * @p21
			p41x = p[1] * @p41

			0 < p21x and p21x < @p21ms and 0 <= p41x and p41x <= @p41ms
		end