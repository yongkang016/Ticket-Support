import {ColorPickerPanel, RectangularBoxMarkerBase, SvgHelper} from 'markerjs2';

export class LedStandMarker extends RectangularBoxMarkerBase {
    strokeColor = 'transparent';
    strokeWidth = 0;

    constructor(container, overlayContainer, settings) {
        super(container, overlayContainer, settings);

        this.strokeColor = settings.defaultColor;
        this.strokeWidth = settings.defaultStrokeWidth;

        this.createVisual = this.createVisual.bind(this);
        this.setStrokeColor = this.setStrokeColor.bind(this);

        this.strokePanel = new ColorPickerPanel(
            'line color',
            settings.defaultColorSet,
            settings.defaultColor,
        );

        this.strokePanel.onColorChanged = this.setStrokeColor;
    }

    createVisual() {
        this.visual = SvgHelper.createImage([
            ['href', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEACAYAAABccqhmAAAAAXNSR0IArs4c6QAAEdlJREFUeF7tnWnodGUZh6+kRbRASiorad/EFsMSl8ps0RJzSyqTiBb6EIIttGCWaVFRphR9aCWwXdQPpSltVpqFUlkitlrZhrQYpoiFNU+N8Rbz/89z5tz3meecuQZU8L3P/Tzn97vnen8zc+bMndi8x32BlwNPAfYEHrV5EnjGOyhwLXA98E3go8AfNkmdO23SyQL3Bj4F7A/sumHn7ulur8DNwOXAi4AbNkWsTQPAacApm2Ku57mSAqcDb1npyBEetEkAKH/7nzOP/iO0yi0PpEB5KXDcpqSATQLAY4CPA/sONEguM04FrgReCvxonNvvtutNAsDjgbOBvbtJZPWGKXA1cAJw1SactwDYBJc9xy4KCIAuao2o1gQwIrPWuFUBsEbxM5cWAJnqTqe3AJiOl/9zJgJgosYGn5YACBa0lXZdAHAB8P1WNu4+QhTYBzi8opMAqBBpjCVdAHAW8OoxnqR73lKBM4GTKvQRABUijbFEAIzRtbg9C4AFWvox4OIBMwHEPfFa6SQABED1hUACoJWnbdw+BIAAEABxz6fRdRIAAkAAjO5pG7dhASAAwgHwOOBZQPmIqXzb0MdwCpTv7P9gdm+Hiyuv2xcAAiAUAMfM7y1QPl3wsT4FCgTKd/jPW7IFASAAwgDwnNntxD4GlNuL+Vi/AuU2Xi8DLtxmKwJAAIQAoET9z8zuIXfI+ufeHeygwNeAF25zIw8BIABCAHAA8GnggT79mlLgV8Dxs/dkvr3FrgSAAAgBwCuBDwB3aWr83czfgROBDwmA+mHwSsDFWm13IdChwEX1Els5oAKHzT8VWLSkCcAEEJIABMCAz+iOSwmAjoKZAEwAHUem6XIB0NEeASAAOo5M0+UCoKM9AiAXAD8HyptTPlZXoLzZ+tDKwwVApVB3lAmAXACUN57KJwY+VlegvLNfe3MWAdBRZwGQC4DyE1PlMlUfqytQfsqt/KRbzUMA1Ki0Q40AEAAdR2bwcgGQKLkAEACJ4xXSWgCEyLi4iQAQAInjFdJaAITIKACibgra5UIg3wPoP7wCoL+GW3YwAZgAEscrpLUACJHRBGACSBykxNYCIFFcE4AJIHG8QloLgBAZTQAmgMRBSmwtABLFNQGYABLHK6S1AAiR0QRgAkgcpMTWAiBRXBOACSBxvEJaC4AQGU0AJoDEQUpsLQASxTUBmAASxyuktQAIkdEEYAJIHKTE1gIgUVwTgAkgcbxCWguAEBlNACaAxEFKbC0AEsU1AZgAEscrpLUACJHRBGACSBykxNYCIFFcE4AJIHG8QloLgBAZTQAmgMRBSmwtABLFNQGYABLHK6S1AAiR0QRgAkgcpMTWAiBRXBOACSBxvEJaC4AQGU0AJoDEQUpsLQASxTUBmAASxyuktQAIkdEEYAJIHKTE1gIgUVwTgAkgcbxCWguAEBlNACaAxEFKbC0AEsU1AZgAEscrpLUACJHRBGACSBykxNYCIFFcE4AJIHG8QloLgBAZTQAmgMRBSmwtABLFNQGYABLHK6S1AAiR0QRgAkgcpMTWAiBRXBOACSBxvEJaC4AQGU0AJoDEQUpsLQASxTUBmAASxyuktQAIkdEEYAJIHKTE1gIgUVwTgAkgcbxCWguAEBlNACaAxEFKbC0AEsU1AZgAEscrpLUACJHRBGACSBykxNYCIFFcE4AJIHG8QloLgBAZTQAmgMRBSmwtABLFNQGYABLHK6S1AAiR0QRgAkgcpMTWAiBRXBPAehPA/YGHALsCtwC/BH6d6PcYWwuARNcEwHoAcBfgZcBRwEFzANwKfAu4APgocHOi72NqLQAS3RIA6wHAG4GTgbsvWP6m2f9/L/B24PZE78fSWgAkOiUAhgfAIcAngT228fV3wCuACxO9H0trAZDolAAYHgBnAydUePqpyrqKVqMuEQCJ9gmAYQFwN+CrwIEVnn4DOBL4a0XtlEsEQKK7AmBYAOw8B8ABFZ5eARwK/KWidsolAiDRXQEgABLHK6S1AAiRcXETATA8AD4PHFHhaXmpcJwJAAFQMSyrlgiAYQGwE/Al4FkVhn1l/h5AuUBokx8CINF9ATAsAMpqrwfeCRQYbPd42+wPT030fiytBUCiUwJgeAA8GjgDePY2vn4R/h19f5Do/VhaC4BEpwTA8AAoK5aLgcpgH7xg+RL9CyAuSvR9TK0FQKJbAmA9ACirPg44fv7f+wLl6r+rgfIm4ZWJno+ttQBIdEwArA8Ad6x8rx2+DfjHRK/H2loAJDonANYPgER7J9FaACTaKAAEQOJ4hbQWACEyLm4iANoAQPlI0K/+LvZCAAiAEAVauyXYfeafBjwFKB8NXgtcCnx99lXg34ac8TSaCIBEH00A60kAjwXKhT77/d99AW6YfwLwVj8J+K8xAkAAhCjQSgK4H/Bh4PBtzuqbs/sDvgS4LuTMx91EACT6ZwIYPgGcNr8IaJmt75lfNrysbup/LgASHRYAwwPgPODoCk/LDUKfAdxWUTvlEgGQ6K4AGBYA95x/G/BJFZ5eP79U+BcVtVMuEQCJ7gqAYQFQ7ghUvujz9ApPfza7KWgBhXcEgvKyqeZxGHDxFoVnAidVNCmXY5d7Nl5VUTv6EgEgAFofYhNAokMCQAAkjldIawEQIuPiJgJAACSOV0hrARAiowBo4ToA3wPoPswCoLtm1UeYAEwA1cOypkIBkCi8ABAAieMV0loAhMjoSwBfAiQOUmJrAZAorgnABJA4XiGtBUCIjCYAE0DiICW2FgCJ4poATACJ4xXSWgCEyGgCMAEkDlJiawGQKK4JwASQOF4hrQVAiIwmABNA4iAlthYAieKaAEwAieMV0loAhMhoAjABJA5SYmsBkCiuCcAEkDheIa0FQIiMJgATQOIgJbYWAInimgBMAInjFdJaAITIaAIwASQOUmJrAZAorgnABJA4XiGtBUCIjCYAE0DiICW2FgCJ4poATACJ4xXSWgCEyGgCMAEkDlJiawGQKK4JwASQOF4hrQVAiIwmABNA4iAlthYAieKaAEwAieMV0loAhMhoAjABJA5SYmsBkCiuCcAEkDheIa0FQIiMJgATQOIgJbYWAInimgBMAInjFdJaAITIaAIwASQOUmJrAZAorgnABJA4XiGtBUCIjCYAE0DiICW2FgCJ4poATACJ4xXSWgCEyGgCMAEkDlJiawGQKK4JwASQOF4hrQVAiIwmABNA4iAlthYAieKaAEwAieMV0loAhMhoAjABJA5SYmsBkCiuCcAEkDheIa0FQIiMJgATQOIgJbYWAInimgBMAInjFdJaAITIaAIwASQOUmJrAZAorgnABJA4XiGtBUCIjCYAE0DiICW2FgCJ4poATACJ4xXSWgCEyGgCMAEkDlJiawGQKK4JwASQOF4hrQVAiIwmABNA4iAlthYAieKaAEwAieMV0loAhMhoAmglAXwWOLLC02uBA4C/VNROuUQAJLprAhg2AdwZOBd4boWnl8zrbqqonXKJAEh0VwAMC4Cy2vuBEys8/Rjw8oq6qZcIgESHBcDwANgHKE/u8t+tHtcBxwPfSfR+LK0FQKJTAmB4AJQVjwBeDTxtwfI/BE6bv1RItH40rQVAolUCYD0AKKs+efavU4G7AbsBNwK3AW8Hvpbo+dhaC4BExwTA+gBQVt4JeDCwK3AL8Cvg74l+j7G1AEh0TQCsFwCJ1k6mtQBItFIACIDE8QppLQBCZFzcRAAIgMTxCmktAEJkFAAtXAmYaOVkWwuARGtNALkJ4ALgZ4n+bULrhwGHV57oYcDFW9SeOfuk5aSKPlfPPDsBuKqidvQlAiAXAKMfkJGdgADoaJgAEAAdR6bpcgHQ0R4BIAA6jkzT5QKgoz0CQAB0HJmmywVAR3sEgADoODJNlwuAjvYIgO4AOAT4HLB7R60tz1Xgj8Dzt/kehZ8CLNBfAHQHwCOBLwAPz51nu3dU4CfzG6j8eIvjBIAA4Gxg74rBOmv+dd2tSs8AXlPRx5LhFChP8O08EQACIAwAewJvAF413Hy70jYKfBB4N3D9NjUCQACEAaBIuQfwEuDQ+dd5d/YpOqgCtwI3z6/8+wTw+yWrCwABEAqAO+S8N1D+Kd/t9zGcArcDN8z/qVlVAAiAFADUDJ8161dAAAgAAbD+5+HadiAABIAAWNvTb/0LCwABIADW/zxc2w4EgAAQAGt7+q1/YQEgAKoBUD5Wesf6Z9YdBCpw8vxj22UtvSHIMoVG+uddbgn2U+AfIz1Pt71YgfK7jDWXbwuAiU5QFwBMVAJPq0IBAVAh0hhLBMAYXRt+zwJgeM0HWVEADCLz6BcRAKO3cPEJCICJGht8WgIgWNBW2h0DnA7s1cqG3EeTClwzewP4zcD5Te4ueFObdEOQhwAfAcodfXyowFYKlF9mfgXwi02QaJMAUPw8b/aDD0dvgrGe48oKlBk5duWjR3bgpgHgicBFwD1H5pPbHUaBPwPlxqJXDLPc+lfZNAAUxQ8GXtfh56bW75I7GEKB8jNu753NxyVDLNbKGpsIgKL9g4Fnzu4ms/88DewSaMg/gT663nH8PYD9KvdV/sb6a2VtVNluwL6Vzb4zg+7fKmuHLLsFKH/rXw58GbhuyMVbWKvPoLaw/ynv4Z3AGytP8KAZ0C6rrI0qOxC4tLLZu4A3VdZaNqACAmBAsTsuJQA6CmZ5dwUEQHfNhjpCAAyl9AavIwDaNV8AtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYAhrdyT2DnimVfC7yyoq6UvAD4XmVtVNkTgM9WNvsQcEZF7a3A9RV1lgQpIACChKxo81TgFOCuwG7AnZccU/784RV9S8lPgX9U1kaVRe+v7P9G4DbgdOAbURu1z9YKCIBhpuPY2ZP+LOABwyw3+lV+M4PBScC5oz+Txk9AAOQbdOA8/u6Xv9SkVvguUF4GXTaps2rsZARAviFnAyfkLzPJFYp2L57kmTVyUgIg14jdgfOBg3KXmWz3S4GjgD9N9gzXfGICINeAPWZP/q8Ae+UuM9nu1wDPmH0a8vvJnuGaT0wA5BpQAHAJ8IjcZSbb/Scz/Q4WAHn+CoA8bUtnAdBPXwHQT7+lRwuApRL1KhAAveRDAPTTb+nRAmCpRL0KBEAv+QRAP/mWHy0AlmvUp6ILAL4K3N5nsREduxPw9Ir9mgAqROpTIgD6qLf82C4AKJe+lje8NuFR3hgtl0YvewiAZQr1/HMB0FPAJYcLgMUCCYDcuavuLgCqpVqpUAAIgJUGZ6iDBECu0gJAAOROWM/uAqCngL4EWElAXwKsJFv8QQIgXtMdO5oATAC5E9azuwDoKaAJYCUBTQAryRZ/kACI13TVBHA5UK4F2IRHuQZg/4oT9WPACpH6lAiAPuotP7bLS4Dl3TavQgAkey4AcgUWAP30FQD99Ft6tABYKlGvAgHQSz6/C9BPvuVHC4DlGvWpEAB91EMA9JNv+dECYLlGfSoEQB/1BEA/9SqOFgAVIvUouQ9wHnBAjx6bfOi3gaOBGzZZhMxzFwCZ6v6nd7m3/TH5y0xyhaLd8yZ5Zo2clADIN8IfBVlNY38cZDXdOh0lADrJtVJx+Qmt9wFHAA9aqcPmHfRL4AvAa9bwk2cbpbYAGMbuXYDj5j/ief/Zy4LHDLPs6Fb5EfDb+Y+OngPcMrozGNmG/wUkbOdqUSYH1gAAAABJRU5ErkJggg=='],
            ['width', '50'],
            ['height', '20'],
        ]);
        this.addMarkerVisualToContainer(this.visual);
    }

    setPoints() {
        super.setSize();
        SvgHelper.setAttributes(this.visual, [
            ['href', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEACAYAAABccqhmAAAAAXNSR0IArs4c6QAAEdlJREFUeF7tnWnodGUZh6+kRbRASiorad/EFsMSl8ps0RJzSyqTiBb6EIIttGCWaVFRphR9aCWwXdQPpSltVpqFUlkitlrZhrQYpoiFNU+N8Rbz/89z5tz3meecuQZU8L3P/Tzn97vnen8zc+bMndi8x32BlwNPAfYEHrV5EnjGOyhwLXA98E3go8AfNkmdO23SyQL3Bj4F7A/sumHn7ulur8DNwOXAi4AbNkWsTQPAacApm2Ku57mSAqcDb1npyBEetEkAKH/7nzOP/iO0yi0PpEB5KXDcpqSATQLAY4CPA/sONEguM04FrgReCvxonNvvtutNAsDjgbOBvbtJZPWGKXA1cAJw1SactwDYBJc9xy4KCIAuao2o1gQwIrPWuFUBsEbxM5cWAJnqTqe3AJiOl/9zJgJgosYGn5YACBa0lXZdAHAB8P1WNu4+QhTYBzi8opMAqBBpjCVdAHAW8OoxnqR73lKBM4GTKvQRABUijbFEAIzRtbg9C4AFWvox4OIBMwHEPfFa6SQABED1hUACoJWnbdw+BIAAEABxz6fRdRIAAkAAjO5pG7dhASAAwgHwOOBZQPmIqXzb0MdwCpTv7P9gdm+Hiyuv2xcAAiAUAMfM7y1QPl3wsT4FCgTKd/jPW7IFASAAwgDwnNntxD4GlNuL+Vi/AuU2Xi8DLtxmKwJAAIQAoET9z8zuIXfI+ufeHeygwNeAF25zIw8BIABCAHAA8GnggT79mlLgV8Dxs/dkvr3FrgSAAAgBwCuBDwB3aWr83czfgROBDwmA+mHwSsDFWm13IdChwEX1Els5oAKHzT8VWLSkCcAEEJIABMCAz+iOSwmAjoKZAEwAHUem6XIB0NEeASAAOo5M0+UCoKM9AiAXAD8HyptTPlZXoLzZ+tDKwwVApVB3lAmAXACUN57KJwY+VlegvLNfe3MWAdBRZwGQC4DyE1PlMlUfqytQfsqt/KRbzUMA1Ki0Q40AEAAdR2bwcgGQKLkAEACJ4xXSWgCEyLi4iQAQAInjFdJaAITIKACibgra5UIg3wPoP7wCoL+GW3YwAZgAEscrpLUACJHRBGACSBykxNYCIFFcE4AJIHG8QloLgBAZTQAmgMRBSmwtABLFNQGYABLHK6S1AAiR0QRgAkgcpMTWAiBRXBOACSBxvEJaC4AQGU0AJoDEQUpsLQASxTUBmAASxyuktQAIkdEEYAJIHKTE1gIgUVwTgAkgcbxCWguAEBlNACaAxEFKbC0AEsU1AZgAEscrpLUACJHRBGACSBykxNYCIFFcE4AJIHG8QloLgBAZTQAmgMRBSmwtABLFNQGYABLHK6S1AAiR0QRgAkgcpMTWAiBRXBOACSBxvEJaC4AQGU0AJoDEQUpsLQASxTUBmAASxyuktQAIkdEEYAJIHKTE1gIgUVwTgAkgcbxCWguAEBlNACaAxEFKbC0AEsU1AZgAEscrpLUACJHRBGACSBykxNYCIFFcE4AJIHG8QloLgBAZTQAmgMRBSmwtABLFNQGYABLHK6S1AAiR0QRgAkgcpMTWAiBRXBOACSBxvEJaC4AQGU0AJoDEQUpsLQASxTUBmAASxyuktQAIkdEEYAJIHKTE1gIgUVwTgAkgcbxCWguAEBlNACaAxEFKbC0AEsU1AZgAEscrpLUACJHRBGACSBykxNYCIFFcE4AJIHG8QloLgBAZTQAmgMRBSmwtABLFNQGYABLHK6S1AAiR0QRgAkgcpMTWAiBRXBPAehPA/YGHALsCtwC/BH6d6PcYWwuARNcEwHoAcBfgZcBRwEFzANwKfAu4APgocHOi72NqLQAS3RIA6wHAG4GTgbsvWP6m2f9/L/B24PZE78fSWgAkOiUAhgfAIcAngT228fV3wCuACxO9H0trAZDolAAYHgBnAydUePqpyrqKVqMuEQCJ9gmAYQFwN+CrwIEVnn4DOBL4a0XtlEsEQKK7AmBYAOw8B8ABFZ5eARwK/KWidsolAiDRXQEgABLHK6S1AAiRcXETATA8AD4PHFHhaXmpcJwJAAFQMSyrlgiAYQGwE/Al4FkVhn1l/h5AuUBokx8CINF9ATAsAMpqrwfeCRQYbPd42+wPT030fiytBUCiUwJgeAA8GjgDePY2vn4R/h19f5Do/VhaC4BEpwTA8AAoK5aLgcpgH7xg+RL9CyAuSvR9TK0FQKJbAmA9ACirPg44fv7f+wLl6r+rgfIm4ZWJno+ttQBIdEwArA8Ad6x8rx2+DfjHRK/H2loAJDonANYPgER7J9FaACTaKAAEQOJ4hbQWACEyLm4iANoAQPlI0K/+LvZCAAiAEAVauyXYfeafBjwFKB8NXgtcCnx99lXg34ac8TSaCIBEH00A60kAjwXKhT77/d99AW6YfwLwVj8J+K8xAkAAhCjQSgK4H/Bh4PBtzuqbs/sDvgS4LuTMx91EACT6ZwIYPgGcNr8IaJmt75lfNrysbup/LgASHRYAwwPgPODoCk/LDUKfAdxWUTvlEgGQ6K4AGBYA95x/G/BJFZ5eP79U+BcVtVMuEQCJ7gqAYQFQ7ghUvujz9ApPfza7KWgBhXcEgvKyqeZxGHDxFoVnAidVNCmXY5d7Nl5VUTv6EgEgAFofYhNAokMCQAAkjldIawEQIuPiJgJAACSOV0hrARAiowBo4ToA3wPoPswCoLtm1UeYAEwA1cOypkIBkCi8ABAAieMV0loAhMjoSwBfAiQOUmJrAZAorgnABJA4XiGtBUCIjCYAE0DiICW2FgCJ4poATACJ4xXSWgCEyGgCMAEkDlJiawGQKK4JwASQOF4hrQVAiIwmABNA4iAlthYAieKaAEwAieMV0loAhMhoAjABJA5SYmsBkCiuCcAEkDheIa0FQIiMJgATQOIgJbYWAInimgBMAInjFdJaAITIaAIwASQOUmJrAZAorgnABJA4XiGtBUCIjCYAE0DiICW2FgCJ4poATACJ4xXSWgCEyGgCMAEkDlJiawGQKK4JwASQOF4hrQVAiIwmABNA4iAlthYAieKaAEwAieMV0loAhMhoAjABJA5SYmsBkCiuCcAEkDheIa0FQIiMJgATQOIgJbYWAInimgBMAInjFdJaAITIaAIwASQOUmJrAZAorgnABJA4XiGtBUCIjCYAE0DiICW2FgCJ4poATACJ4xXSWgCEyGgCMAEkDlJiawGQKK4JwASQOF4hrQVAiIwmABNA4iAlthYAieKaAEwAieMV0loAhMhoAjABJA5SYmsBkCiuCcAEkDheIa0FQIiMJgATQOIgJbYWAInimgBMAInjFdJaAITIaAIwASQOUmJrAZAorgnABJA4XiGtBUCIjCYAE0DiICW2FgCJ4poATACJ4xXSWgCEyGgCMAEkDlJiawGQKK4JwASQOF4hrQVAiIwmABNA4iAlthYAieKaAEwAieMV0loAhMhoAmglAXwWOLLC02uBA4C/VNROuUQAJLprAhg2AdwZOBd4boWnl8zrbqqonXKJAEh0VwAMC4Cy2vuBEys8/Rjw8oq6qZcIgESHBcDwANgHKE/u8t+tHtcBxwPfSfR+LK0FQKJTAmB4AJQVjwBeDTxtwfI/BE6bv1RItH40rQVAolUCYD0AKKs+efavU4G7AbsBNwK3AW8Hvpbo+dhaC4BExwTA+gBQVt4JeDCwK3AL8Cvg74l+j7G1AEh0TQCsFwCJ1k6mtQBItFIACIDE8QppLQBCZFzcRAAIgMTxCmktAEJkFAAtXAmYaOVkWwuARGtNALkJ4ALgZ4n+bULrhwGHV57oYcDFW9SeOfuk5aSKPlfPPDsBuKqidvQlAiAXAKMfkJGdgADoaJgAEAAdR6bpcgHQ0R4BIAA6jkzT5QKgoz0CQAB0HJmmywVAR3sEgADoODJNlwuAjvYIgO4AOAT4HLB7R60tz1Xgj8Dzt/kehZ8CLNBfAHQHwCOBLwAPz51nu3dU4CfzG6j8eIvjBIAA4Gxg74rBOmv+dd2tSs8AXlPRx5LhFChP8O08EQACIAwAewJvAF413Hy70jYKfBB4N3D9NjUCQACEAaBIuQfwEuDQ+dd5d/YpOqgCtwI3z6/8+wTw+yWrCwABEAqAO+S8N1D+Kd/t9zGcArcDN8z/qVlVAAiAFADUDJ8161dAAAgAAbD+5+HadiAABIAAWNvTb/0LCwABIADW/zxc2w4EgAAQAGt7+q1/YQEgAKoBUD5Wesf6Z9YdBCpw8vxj22UtvSHIMoVG+uddbgn2U+AfIz1Pt71YgfK7jDWXbwuAiU5QFwBMVAJPq0IBAVAh0hhLBMAYXRt+zwJgeM0HWVEADCLz6BcRAKO3cPEJCICJGht8WgIgWNBW2h0DnA7s1cqG3EeTClwzewP4zcD5Te4ueFObdEOQhwAfAcodfXyowFYKlF9mfgXwi02QaJMAUPw8b/aDD0dvgrGe48oKlBk5duWjR3bgpgHgicBFwD1H5pPbHUaBPwPlxqJXDLPc+lfZNAAUxQ8GXtfh56bW75I7GEKB8jNu753NxyVDLNbKGpsIgKL9g4Fnzu4ms/88DewSaMg/gT663nH8PYD9KvdV/sb6a2VtVNluwL6Vzb4zg+7fKmuHLLsFKH/rXw58GbhuyMVbWKvPoLaw/ynv4Z3AGytP8KAZ0C6rrI0qOxC4tLLZu4A3VdZaNqACAmBAsTsuJQA6CmZ5dwUEQHfNhjpCAAyl9AavIwDaNV8AtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYA2rVSALTrzWR2JgDatVIAtOvNZHYmANq1UgC0681kdiYAhrdyT2DnimVfC7yyoq6UvAD4XmVtVNkTgM9WNvsQcEZF7a3A9RV1lgQpIACChKxo81TgFOCuwG7AnZccU/784RV9S8lPgX9U1kaVRe+v7P9G4DbgdOAbURu1z9YKCIBhpuPY2ZP+LOABwyw3+lV+M4PBScC5oz+Txk9AAOQbdOA8/u6Xv9SkVvguUF4GXTaps2rsZARAviFnAyfkLzPJFYp2L57kmTVyUgIg14jdgfOBg3KXmWz3S4GjgD9N9gzXfGICINeAPWZP/q8Ae+UuM9nu1wDPmH0a8vvJnuGaT0wA5BpQAHAJ8IjcZSbb/Scz/Q4WAHn+CoA8bUtnAdBPXwHQT7+lRwuApRL1KhAAveRDAPTTb+nRAmCpRL0KBEAv+QRAP/mWHy0AlmvUp6ILAL4K3N5nsREduxPw9Ir9mgAqROpTIgD6qLf82C4AKJe+lje8NuFR3hgtl0YvewiAZQr1/HMB0FPAJYcLgMUCCYDcuavuLgCqpVqpUAAIgJUGZ6iDBECu0gJAAOROWM/uAqCngL4EWElAXwKsJFv8QQIgXtMdO5oATAC5E9azuwDoKaAJYCUBTQAryRZ/kACI13TVBHA5UK4F2IRHuQZg/4oT9WPACpH6lAiAPuotP7bLS4Dl3TavQgAkey4AcgUWAP30FQD99Ft6tABYKlGvAgHQSz6/C9BPvuVHC4DlGvWpEAB91EMA9JNv+dECYLlGfSoEQB/1BEA/9SqOFgAVIvUouQ9wHnBAjx6bfOi3gaOBGzZZhMxzFwCZ6v6nd7m3/TH5y0xyhaLd8yZ5Zo2clADIN8IfBVlNY38cZDXdOh0lADrJtVJx+Qmt9wFHAA9aqcPmHfRL4AvAa9bwk2cbpbYAGMbuXYDj5j/ief/Zy4LHDLPs6Fb5EfDb+Y+OngPcMrozGNmG/wUkbOdqUSYH1gAAAABJRU5ErkJggg=='],
            ['width', this.width],
            ['height', this.height],
        ]);
    }

    pointerDown(point, target) {
        super.pointerDown(point, target);
        if (this.state === 'new') {
            this.createVisual();
            this.moveVisual(point);
            this._state = 'creating';
        }
    }

    resize(point) {
        super.resize(point);
        this.setPoints();
    }

    pointerUp(point) {
        super.pointerUp(point);
        this.setPoints();
    }

    ownsTarget(el) {
        if (super.ownsTarget(el) || el === this.visual) {
            return true;
        } else {
            return false;
        }
    }

    setStrokeColor(color) {
        this.strokeColor = color;
        if (this.visual) {
            SvgHelper.setAttributes(this.visual, [['stroke', this.strokeColor]]);
        }
    }

    get toolboxPanels() {
        return [this.strokePanel];
    }

    getState() {
        const result = Object.assign({
            strokeColor: this.strokeColor
        }, super.getState());
        result.typeName = LedStandMarker.typeName;

        return result;
    }

    restoreState(state) {
        const rectState = state;
        this.strokeColor = rectState.strokeColor;

        this.createVisual();
        super.restoreState(state);
        this.setPoints();
    }

    scale(scaleX, scaleY) {
        super.scale(scaleX, scaleY);
        this.setPoints();
    }
}

LedStandMarker.typeName = 'LedStandMarker';
LedStandMarker.title = 'Led Stand Marker';
LedStandMarker.icon = '<svg fill="#ffffff" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M383.549,0H128.452c-5.633,0-10.199,4.567-10.199,10.199v360.439c0,5.632,4.566,10.199,10.199,10.199h77.07v73.583 h-18.719c-5.633,0-10.199,4.567-10.199,10.199v37.181c0,5.632,4.566,10.199,10.199,10.199h138.392 c5.633,0,10.199-4.567,10.199-10.199v-37.18c0-5.632-4.566-10.199-10.199-10.199h-18.719v-73.583h77.07 c5.633,0,10.199-4.567,10.199-10.199V10.199C393.748,4.567,389.182,0,383.549,0z M314.998,474.82v16.782H197.003V474.82H314.998z M225.922,454.421v-73.583h60.158v73.583H225.922z M373.348,360.439H138.651V20.398h234.697V360.439z"></path> </g> </g> <g> <g> <path d="M347.918,35.115H164.083c-5.633,0-10.199,4.567-10.199,10.199v290.21c0,5.632,4.566,10.199,10.199,10.199h183.835 c5.633,0,10.199-4.567,10.199-10.199V45.314C358.117,39.682,353.551,35.115,347.918,35.115z M337.719,325.325H174.282V55.513 h163.436V325.325z"></path> </g> </g> <g> <g> <path d="M195.066,188.998c-5.633,0-10.199,4.567-10.199,10.199v104.31c0,5.632,4.566,10.199,10.199,10.199 c5.633,0,10.199-4.567,10.199-10.199v-104.31C205.266,193.565,200.699,188.998,195.066,188.998z"></path> </g> </g> <g> <g> <path d="M195.066,153.884c-5.633,0-10.199,4.567-10.199,10.199v5.164c0,5.632,4.566,10.199,10.199,10.199 c5.633,0,10.199-4.567,10.199-10.199v-5.164C205.266,158.45,200.699,153.884,195.066,153.884z"></path> </g> </g> </g></svg>';
