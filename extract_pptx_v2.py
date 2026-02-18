import zipfile
import xml.etree.ElementTree as ET
import sys

def get_slide_text(pptx_path, slide_num):
    try:
        with zipfile.ZipFile(pptx_path, 'r') as zip_ref:
            # Slides are usually named slide1.xml, slide2.xml...
            # But the index might differ in the zip structure
            slide_path = f'ppt/slides/slide{slide_num}.xml'
            if slide_path not in zip_ref.namelist():
                return f"Error: {slide_path} not found in zip"
                
            xml_content = zip_ref.read(slide_path)
            tree = ET.fromstring(xml_content)
            
            # Namespaces
            ns = {
                'a': 'http://schemas.openxmlformats.org/drawingml/2006/main',
                'p': 'http://schemas.openxmlformats.org/presentationml/2006/main'
            }
            
            texts = []
            for t in tree.findall('.//a:t', ns):
                if t.text:
                    texts.append(t.text)
            
            return " ".join(texts)
    except Exception as e:
        return f"Error: {e}"

if __name__ == "__main__":
    path = "doc/하늘누리 웹사이트 구축프로젝트 화면설계서_관리자사이트_ver 0.96.pptx"
    for i in range(47, 48):
        text = get_slide_text(path, i)
        print(f"--- Slide {i} ---")
        print(text)
        print()
