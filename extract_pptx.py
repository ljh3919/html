import zipfile
import xml.etree.ElementTree as ET
import sys

def get_slide_text(pptx_path, slide_num):
    try:
        with zipfile.ZipFile(pptx_path, 'r') as zip_ref:
            xml_content = zip_ref.read(f'ppt/slides/slide{slide_num}.xml')
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
    path = "doc/하늘누리 웹사이트 구축프로젝트 화면설계서_관리자사이트_이부장님 문의에 대한 답변_ver 0.95.pptx"
    for i in [11, 16, 17, 18]:
        print(f"--- Slide {i} ---")
        print(get_slide_text(path, i))
        print()
