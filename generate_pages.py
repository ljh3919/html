import os

def create_blade(path, page_id, depths, desc):
    os.makedirs(os.path.dirname(path), exist_ok=True)
    depth_str = " > ".join([d for d in depths if d])
    content = f"""@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{depth_str}</h1>
    <p>페이지 ID: {page_id}</p>
    {"<p>설명: " + desc + "</p>" if desc else ""}
</div>
@endsection
"""
    with open(path, "w", encoding="utf-8") as f:
        f.write(content)

def main():
    if not os.path.exists("ia_dump.txt"):
        print("ia_dump.txt not found")
        return

    with open("ia_dump.txt", "r", encoding="utf-8") as f:
        lines = f.readlines()

    current_group = ""
    for i, line in enumerate(lines[3:]):  # Skip header
        cols = line.strip("\n").split("\t")
        if not cols or len(cols) < 5: 
            if cols and cols[0].strip():
                current_group = cols[0].strip()
            continue
        
        # Determine group (Front or Admin)
        first_col = cols[0].strip()
        if first_col:
            current_group = first_col
        
        group_type = "admin" if "관리자" in current_group else "front"
        
        depth1 = cols[1].strip()
        depth2 = cols[2].strip()
        depth3 = cols[3].strip()
        page_id = cols[4].strip()
        desc = cols[7].strip() if len(cols) > 7 else ""
        
        if not page_id or page_id == "-" or " " in page_id: 
            continue
        
        id_clean = page_id.lower().replace("_", "")
        
        folder = ""
        if "main" in id_clean: folder = "main"
        elif "join" in id_clean: folder = "join"
        elif "login" in id_clean: folder = "login"
        elif "meminfo" in id_clean: folder = "mem-info"
        elif "introdu" in id_clean: folder = "introdu"
        elif "facil" in id_clean: folder = "facil"
        elif "distriinfo" in id_clean: folder = "distri-info"
        elif any(x in id_clean for x in ["memorial", "dead", "letter"]):
            if group_type == "admin":
                folder = "memorial/deadmag" if "dead" in id_clean else "memorial/lettermag"
            else:
                folder = "memorial/deadsearch" if "dead" in id_clean else "memorial/letter"
        elif "customer" in id_clean:
            if "notice" in id_clean: folder = "customer/notice"
            elif "faq" in id_clean: folder = "customer/faq"
            elif "councel" in id_clean: folder = "customer/councel"
            elif "referen" in id_clean: folder = "customer/referen"
            elif "reply" in id_clean: folder = "customer/councel"
            else: folder = "customer"
        elif "admag" in id_clean: folder = "admag"
        elif "memmag" in id_clean: folder = "memmag"
        elif "popup" in id_clean: folder = "popup"
        elif "brochure" in id_clean: folder = "brochure"
        elif any(x in id_clean for x in ["skyscraper", "phone"]): folder = "skyscraper"
        
        if folder:
            file_path = f"resources/views/{group_type}/{folder}/{page_id}.blade.php"
            create_blade(file_path, page_id, [depth1, depth2, depth3], desc)
            print(f"Created: {file_path}")
        else:
            print(f"Skipped (No folder match): {page_id} (Group: {current_group})")

if __name__ == "__main__":
    main()
