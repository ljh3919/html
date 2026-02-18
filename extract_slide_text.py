import zipfile
import xml.etree.ElementTree as ET
import sys

def extract_text_from_slide(pptx_path, slide_number):
    try:
        with zipfile.ZipFile(pptx_path, 'r') as z:
            slide_xml_path = f'ppt/slides/slide{slide_number}.xml'
            if slide_xml_path not in z.namelist():
                print(f"Slide {slide_xml_path} not found in {pptx_path}")
                return
            
            with z.open(slide_xml_path) as f:
                tree = ET.parse(f)
                root = tree.getroot()
                
                # Namespaces
                ns = {
                    'a': 'http://schemas.openxmlformats.org/drawingml/2006/main',
                    'p': 'http://schemas.openxmlformats.org/presentationml/2006/main',
                    'r': 'http://schemas.openxmlformats.org/officeDocument/2006/relationships'
                }
                
                texts = []
                for t in root.findall('.//a:t', ns):
                    if t.text:
                        texts.append(t.text)
                
                return "\n".join(texts)
    except Exception as e:
        print(f"Error: {e}")
        return None

if __name__ == "__main__":
    pptx_path = "doc/하늘누리 웹사이트 구축프로젝트 화면설계서_관리자사이트_이부장님 문의에 대한 답변_ver 0.95.pptx"
    for page in [5, 6, 7, 8, 9]:
        slide_text = extract_text_from_slide(pptx_path, page)
        if slide_text:
            print(f"--- Slide {page} Text ---")
            print(slide_text)
            print("\n" + "="*50 + "\n")
