<?php

// This class was generated on Wed, 01 Aug 2018 16:35:04 PDT by version 0.1.0-dev+0ee05a-dirty of Braintree SDK Generator
// RefundsGetRequest.php
// @version 0.1.0-dev+0ee05a-dirty
// @type request
// @data H4sIAAAAAAAC/+xc4VPjOLL//v6KLu+rekNVSFhmYHf59NiB2eG9ZeCAuaorjkoUqxNrkSWv1E7Ibc3/fiXJTmI7XtiZwN7N+QNFuVuyuqXWr7vljn6LPrAUo6PI4CRX3PanSFEvOkEbG5GR0Co6iq4TPbfAkZiQFibaAIPQvgfjBZyd9KNe9JcczeKSGZYiobHR0e1dL3qPjKOpU99pk9Zpl4ySCu236GaROcksGaGmUS/6KzOCjSVWJB4KHvWi/8dFQW0If5MgXLLFJZO7U1RoGCGHsxOvBiVYKOIf54mIEyANNtHzUl+n27ExbBHE2etFV8j4hZKL6GjCpEVH+DUXBnl0RCbHXnRpdIaGBNroSOVSfroLbdBSeIkjOpLNtLIYaEt9r7xATX0fV7NQRaiJNilzjD8kfEFYl361Cuda4aIpFEt1rqgi2pLUFDDOjUEVL4ApDqFdYU4ToZiKBZNAhinLYterBzaPE2AWGIyZZCpG0AYytkhREfAct6dfm5WVIg9jzbGiZ53TVPeWEoO4GyfMsJjQwNn1xe6b/W+/W02E63v3asB1bAdCEU6NX7cBFwZjGhi0NCgb77rGdrADlDACwVGRmAi03ozLRtsw196jszJjMq/ORklpzoLn9IrNlYppQjDGo7/ne3uv41z6/xiepAhPxwr8XKDx1lGo5jSV4h5h9H+XfxuFSWAGQWkCWmQiZlIuYGKC7TDZDy8dlG+tjQEcY5EyueyxeaybDydrY9l8zMVMcHS7jDRQonPLFKfEbh5uUGr4bgk3YfJB5ekYDejJUpBMshhLfK1YSA8sIty+LWlvnSH8UbPZCpA9wTZig4xwSCKt7ZcKvWknnBF6YHAteiAU3J4pQqOQqjwI8Hb3KiHK7NFgQFpL2xdIk74200FCqRyYSfz69esfvrHoF3f3oH+404drjLXi1q/lciXmiZC4Zjhg11rprGJNY6nj+19zTbi+ypaMVtNA+aCptO7BOh0CQk9zyQzgQ2bQWmd1mdHOoCxMc8E9xI1zAq7Ress2+AvGBExKEGrGpOB+MpbmVhfoCwHxifu/5nT94+e43f4LiatmWsRYjxUq5Kb4KZo4YYp2OU6ECuLriZe+6FloI+zzqPOzUPewLldDMSnUva3oVFKq6hwrYE4uJ79B6Rfj9v3xzenF8TX4LiWasEwM9AzNTOB88E3CCDWzu75JHUEOt+9tUcW+xbpGK9qmJeKCOfR3S7IWv+XjVNASb9F6BGEvZG2JwUlFg4KwIR7SaSaREIiZKRJ8vPq5DzcaUnaPhfRhrZxv67nmY6ECJ0VKNIe5oCRY4O3HqzO4wTRzPXYDRBLyR1Hy8OC7vR1vA31wTiozuJsZHTt4UlOHw7HMeRh09N+jHoxejXoei0c7I1jGNrbvAW7kdB2BCEHJPS6gtDKnq1YubvPe1FuU83PFFAQdgz7MLaB1C6fIk19o4bw1Nexvnfp7FthzgWoJFeMF3F69ewv7e28OV0swn89XC2AmsftzLfr0QDv9YquPi4jOzVBhGC+mv7OpmvIFqan5+5uby9IMl76UWoz3hTQwKCvih+cNkbmfXC+g88Fu+R7dKAc/fP/9Mpx4s1NGtBbNDK1PUlTp4FixeM7Qc8XSsZjmOrdyAbyyxBZTpkjEtvQrYRteu2DPg/9VIaGt2RBTzMvGrBVT5bIhO3B9d0uV6o/9B6fGznM4qOs4wZQ118KW9NVyLEmbctcVTrskb4vWv3I7euyCqQ1ZLOcihHlnhGnVoTZ5VeG3O6PHUsLFBNxQG8SU8qLqWUpKu7e3+Xg3THuB0H6C09wS+GjSB9ZTJpQNQeZ6+y9093XV1OJ3VFOLumoFZTuqaeWPDlIdkrhnUrHNvrxX8FZUta0q/Tntql2yDBUPGW9NtArjOWVrA/OJYVMHbVdotcyLAHgl4Ub2nzGHooEZYiNSHCtwjGfA4O0kBr7FlnfEuQuPWiKtZpT1WIzvos5YK8IH2kUVay7UFPxWfoGTwLFQzCxOi2ErwjdYm0J9RaiaYgdnf55LElluMm0Rlqce50xIOH0gVNZBBLw6Pzs/3YFLZgguFB65eD1l5NZu1QetZVOEHzUXaB8Navb33hzsvFBwRvXImh4Pqj97fm7m+gi89YET60kzcbidmbh7AmYoXT00D8/PiV4XCtvdr1ZYc78lZXvud9V+yxjTZm8Zo+SamKnO9Dq1ZnkaWJbJRcing6jgD3kRnBZMxWj/Bz5endkeWPcKz3LPa3m4P+7uv4znyVyKb9Raz5qmDe6f4R+zFvGeV667p+YpIcm4bmYrNUaXs3Q5S5ezdDlLl7N0OUuXs3Q5S5ezdDlLl7N0Ocsz5SytiCRI1iCpoDQxKSQkjt1/KfGUJhySHmZsgaYOFxXOpnyK2aIO69lKRM6Log64ZAsnNvxokN1zPd9QXWFRSjROYEccjtdarn3Tam/U1HDJLT/4bUfHR8s0p0ZbO9xQrFljdCWbXclmV7L51ZZstqCDQtqEDRVyhwwdMnTI8NUiwwckOA57eBkQteRdK1hoiYhaGrRnZauoyJuXXUaALmEOb+rDFVJulC/XRlXZJdVYCoQFLiYTNA5WJkanGxuH2mRgceyVnidoysLKIkBMtOR+OwoD4bdRWyt/bcHhWKsZGkK+CY03MDtM7jC5w+SvFpNPHxwQTRGuGOGGWvmCPTSBvVYxX+M0TaZsAa5FmH2OhCYVqjD3AjxIQwE8AUq1WgMZ0sCUpgTN5+2Oz8ILq3MT47AcsJqLN3j/hpjxBYfV/tPz5qlp8v6jpuaP4GnxY4yVLy0ikNNfczFjEsO2cDshV4LKgCLY3kqv4kMHIXf+tYRbbZZo5AUIh7DuXaTh2wPgYirIlie4xoN5McASxbRQtPXzvJaQpDzW2hCQNFhdONKFI1048pWFI0/DiIzJ4QSxjg8rcocNHTZ02PDVpiqXktFEmxTe4YZMJSu4Dgtq31NrnPYzorJl2PSGlDMIROt/FZsK/1t623PcsdH3aNgUPf/3vyYedheidCDYgWAHglv5ulaeHP/ILG4Mk5oRUktwtH7XVuVQep5oMBijmBVm7k+mPXxMcjkRUgayNhxNKHFa9hUWmLQa7pWeKwcirqGX4flRA1Mm5JBxbtBWXUCd05wM4WvnWDBi8Q/k4PtA0efLb2b5mLmE+/DN2m0G3riZlHqOHMY40SZUcu4fHLS1YhOHaG5OwxjOysIA/1sMuqKAFVPVh/d6jjM0Pd8rXJPitiyLY8wIOaTsQaR5ChLVlJKwEVRVe7eq+wdvGhcxFIVUMENTYqLbsgpy5SeJP1VKwAdh6U++b6a04foNLlV62w003sgNnJ2UoOt2AqTM3iN3E+Tv4dn8XagAJWeCyoGcW4Lc4rJ2znAfjQgspr3ez4JBP8JYLgBVbBZ+Yb27h8zozAgkZhYwcworf9jj4OP1vuub23Clgi/ALS9VsLnc1vHPE5I70sTkMARPmz9MtbXoop0u2umina/4OKj1Cw0xyqtOfklq2kdglfAbs4xys+1a5OswxkmIqtokHvIlvy75Gqs9WKuWIYSOz49QoWi2dutNQWotsZ0ni3VZkyIYHF2efjg5+/DTyOHs6N3x2c+nJ6MtafLkCuI84xvvD6zSu/sD/3XvD7z71Iveht8OFWvNskyKOIDUL8E23xNl5+F2qaPop9ObKNwBHB1Fg9n+oHDydlDcSzz4bXnd76eoF13fi2w5/ulDhjEhD7vcgWN0tL+39+m//gkAAP//
// DO NOT EDIT

namespace PayPalCheckoutSdk\Payments;

use BraintreeHttp\HttpRequest;

class RefundsGetRequest extends HttpRequest
{
    function __construct($refundId)
    {
        parent::__construct("/v2/payments/refunds/{refund_id}?", "GET");

        $this->path = str_replace("{refund_id}", urlencode($refundId), $this->path);
        $this->headers["Content-Type"] = "application/json";
    }


}
