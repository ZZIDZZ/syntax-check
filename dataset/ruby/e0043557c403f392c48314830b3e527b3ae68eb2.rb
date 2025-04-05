def newton_iter(r, n, p, x, y, w)
      t1 = (r+1)**n
      t2 = (r+1)**(n-1)
      ((y + t1*x + p*(t1 - 1)*(r*w + 1)/r) / (n*t2*x - p*(t1 - 1)*(r*w + 1)/(r**2) + n*p*t2*(r*w + 1)/r + p*(t1 - 1)*w/r))
    end