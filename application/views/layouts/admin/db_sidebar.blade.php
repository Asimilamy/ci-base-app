<li class="header">MAIN NAVIGATION</li>
@foreach ($menus as $menu)
    @if ($menu->level == '0')
        @if ($menu->link != 'javascript:void(0);')
            @php
                $link = $menu->module . '/' . $menu->link;
            @endphp
            <li>
                <a href="{{ base_url($link) }}">
                    <i class="{{ $menu->icon }}"></i> <span>{{ $menu->title }}</span>
                </a>
            </li>
        @else
            @php
                $link = $menu->module . '/' . $menu->name;
            @endphp
            <li class="treeview">
                <a href="{{ $menu->link }}">
                    <i class="{{ $menu->icon }}"></i> <span>{{ $menu->title }}</span>
					<i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    @foreach ($menus as $menu_child)
                        @if ($menu_child->level == '1' && $menu_child->parent_id == $menu->id)
                            @if ($menu_child->link != 'javascript:void(0);')
                                @php
                                    $child_link = $link . '/' . $menu_child->link;
                                @endphp
                                <li>
                                    <a href="{{ base_url($child_link) }}">
                                        <i class="{{ $menu_child->icon }}"></i> {{ $menu_child->title }}
                                    </a>
                                </li>
                            @else
                                @php
                                    $child_link = $link . '/' . $menu_child->name;
                                @endphp
                                <li class="treeview">
                                    <a href="{{ $menu_child->link }}">
                                        <i class="{{ $menu_child->icon }}"></i> <span>{{ $menu_child->title }}</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        @foreach ($menus as $menu_grandchild)
                                            @if (
                                                $menu_grandchild->level == '2' &&
                                                $menu_grandchild->parent_id == $menu_child->id
                                            )
                                                @php
                                                    $grandchild_link = $child_link . '/' . $menu_grandchild->link;
                                                @endphp
                                                <li>
                                                    <a href="{{ base_url($grandchild_link) }}">
                                                        <i class="{{ $menu_grandchild->icon }}"></i> {{ $menu_grandchild->title }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </li>
        @endif
    @endif
@endforeach
