#!/usr/bin/env python3
try:
    from Tkinter import Tk
except ImportError:
    from tkinter import Tk

spacing = 0.11  # m
lines = []
for c in range(-12, 13):
    rs = [range(240), reversed(range(240))][c % 2]
    for r in rs:
        lines.append('  {"point": [%.2f, %.2f, %.2f]}' %
                     (c*spacing, 0, (r - 24.5)*spacing))
r=Tk()
r.clipboard_clear()
r.clipboard_append('[\n' + ',\n'.join(lines) + '\n]')
r.update()
r.destroy()