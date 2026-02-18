import zipfile
import xml.etree.ElementTree as ET
import sys

def parse_xlsx(file_path):
    with zipfile.ZipFile(file_path, 'r') as z:
        # Load shared strings
        with z.open('xl/sharedStrings.xml') as f:
            tree = ET.parse(f)
            root = tree.getroot()
            # Handle potential namespaces
            ns = {'ns': 'http://schemas.openxmlformats.org/spreadsheetml/2006/main'}
            shared_strings = []
            for si in root.findall('ns:si', ns):
                t = si.find('ns:t', ns)
                if t is not None:
                    shared_strings.append(t.text)
                else:
                    # Handle rich text strings
                    parts = si.findall('.//ns:t', ns)
                    shared_strings.append("".join(p.text for p in parts if p.text))

        # Load sheet1
        with z.open('xl/worksheets/sheet1.xml') as f:
            tree = ET.parse(f)
            root = tree.getroot()
            rows = []
            for row in root.findall('.//ns:row', ns):
                r = []
                for c in row.findall('ns:c', ns):
                    v = c.find('ns:v', ns)
                    if v is not None:
                        val = v.text
                        if c.get('t') == 's':
                            val = shared_strings[int(val)]
                        r.append(val)
                    else:
                        r.append("")
                rows.append(r)
            return rows

if __name__ == "__main__":
    file_path = "doc/하늘누리 웹사이트 구축 프로젝트_IA_ver0.91_260124.xlsx"
    rows = parse_xlsx(file_path)
    for row in rows:
        print("\t".join(str(cell) for cell in row))
